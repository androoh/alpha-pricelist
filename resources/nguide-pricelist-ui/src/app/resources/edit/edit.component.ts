import {Component, OnDestroy, OnInit} from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {FormControl, FormGroup} from '@angular/forms';
import {FormlyConfig, FormlyFieldConfig, FormlyFormOptions} from '@ngx-formly/core';
import {DynamicFormService} from '@ng-dynamic-forms/core';
import {CreateEditResponse, ResourcesResponse, ResourcesService} from '../../shared/services/resources.service';
import {AlertsService, AlertType} from '../../shared/services/alerts.service';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';
import {BehaviorSubject, Observable, Subscription} from 'rxjs';
import {FormlyFieldConfigCustom} from '../../shared/formly-field-config-custom';
import { LoadingService } from 'src/app/shared/services/loading.service';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.scss']
})
export class EditComponent implements OnInit, OnDestroy {

  private resourceName: string | null = null;
  private resourceId: string | null = null;
  resourceInfo: ResourcesResponse | null = null;
  form: FormGroup = new FormGroup({});
  languageControl = new FormControl('');
  options: FormlyFormOptions = {};
  model: any = {};
  originalSchema: any;
  fields: FormlyFieldConfigCustom[] | null = [];
  language = 'en';
  locales: any[] = [];
  defaultLocale = 'nl';
  hideForm = false;
  isProcessing = true;
  canDownload = false;
  downloadUrl = '';
  poll$: Subscription | null = null;

  constructor(private activatedRoute: ActivatedRoute,
              private router: Router,
              private formlyConfig: FormlyConfig,
              private formService: DynamicFormService,
              private loadingService: LoadingService,
              private alertsService: AlertsService,
              private breadcrumbService: BreadcrumbService,
              private resourcesService: ResourcesService) {
  }

  ngOnInit(): void {
    this.activatedRoute.paramMap.subscribe(params => {
      this.resourceName = params.get('name');
      this.resourceId = params.get('id');
      this.loadData();
    });
    this.languageControl.valueChanges.subscribe((language: string) => {
      if (language && this.originalSchema && this.originalSchema.length > 0) {
        this.loadingService.startLoading('select-language');
        setTimeout(() => {
          this.fields = this.mapFields(JSON.parse(JSON.stringify(this.originalSchema)), language);
          this.loadingService.endLoading('select-language');
        }, 100);
      }
      if (language && this.isPriceList && this.resourceId) {
        this.poll$?.unsubscribe();
        this.poll$ = this.resourcesService.pollDownload(this.resourceId, language).subscribe((data: any) => {
          if (data) {
            if (data?.status === 'success' && data?.url) {
              this.canDownload = true;
              this.downloadUrl = data.url;
            } else {
              this.canDownload = false;
              this.downloadUrl = '';
            }
            if (data?.status === 'progress') {
              this.isProcessing = true;
            } else {
              this.isProcessing = false;
            }
          }
        })
      }
    });
  }

  get isPriceList(): boolean {
    return this.resourceName === 'priceList';
  }

  loadData(): void {
    if (this.resourceName) {
      this.resourcesService.getResourceInfo(this.resourceName).subscribe((resourceInfo: ResourcesResponse) => {
        this.resourceInfo = resourceInfo;
        this.initBreadcrumb();
        if (this.resourceName) {
          if (this.resourceId) {
            this.resourcesService.getEditResourceSchema(this.resourceName, this.resourceId).subscribe((response: CreateEditResponse) => {
              this.locales = this.mapLocales(response.locales);
              this.defaultLocale = response.defaultLocale;
              this.languageControl.setValue(this.defaultLocale);
              this.model = response.data || {};
              this.originalSchema = response.schema;
              this.fields = this.mapFields(JSON.parse(JSON.stringify(response.schema)), this.languageControl.value);
            });
          } else {
            this.resourcesService.getCreateResourceSchema(this.resourceName).subscribe((response: CreateEditResponse) => {
              this.locales = this.mapLocales(response.locales);
              this.defaultLocale = response.defaultLocale;
              this.languageControl.setValue(this.defaultLocale, {emitEvent: false});
              this.model = {};
              this.originalSchema = response.schema;
              this.fields = this.mapFields(JSON.parse(JSON.stringify(response.schema)), this.languageControl.value);
            });
          }
        }
      });
    }
  }

  mapLocales(locales: any): any[] {
    const result: any[] = [];
    for (const localeKey in locales) {
      result.push({
        key: localeKey,
        value: locales[localeKey]
      });
    }
    return result;
  }

  get action(): string {
    return (this.resourceId) ? 'edit' : 'create';
  }

  /**
   * Adjust the JSON fields loaded from the server.
   */
  mapFields(fields: FormlyFieldConfig[], language: string) {
    return fields.map((f: any) => {
      if (f.hasOwnProperty('fieldGroup')) {
        f.fieldGroup = this.mapFields(f.fieldGroup, language);
      } else if (f.type === 'repeat') {
        f.fieldArray.fieldGroup = this.mapFields(f.fieldArray.fieldGroup, language);
      }

      if (language !== this.defaultLocale) {
        if (f.type === 'translatable-input' || f.type === 'translatable-textarea' ||  f.type === 'images') {
          f.templateOptions.required = false;
        }
      }

      if (f.type === 'translatable-input' || f.type === 'translatable-textarea' || f.type === 'images') {
        f.templateOptions['translatable'] = true;
        f.wrappers = [...(f.wrappers || []), 'translatable'];
      }
        if (!f.templateOptions?.language) {
          f.templateOptions.language = new BehaviorSubject(language);
        } else {
          f.templateOptions.language.next(language);
        }
      f.resourceId = this.resourceId;
      f.resourceName = this.resourceName;
      f.templateOptions['defaultLocale'] = this.defaultLocale;
      return f;
    });
  }

  submit() {
    if (this.form && this.form.valid) {
      if (this.resourceName) {
        if (this.resourceId) {
          this.resourcesService.updateResource(this.resourceName, this.resourceId, this.form.value).subscribe((result) => {
            this.alertsService.show(AlertType.success, 'Resource updated!');
          });
        } else {
          this.resourcesService.createResource(this.resourceName, this.form.value).subscribe((result: CreateEditResponse) => {
            this.router.navigate(['/resources', this.resourceName, result.data._id, 'edit']);
            this.alertsService.show(AlertType.success, 'Resource created!');
          });
        }
      }
    }
  }

  setPrices(): void {
    this.router.navigate(['/price-assign', this.resourceId]);
  }

  initBreadcrumb(): void {
    this.breadcrumbService.setBreadcrumb([
      {
        label: 'Home',
        path: ['/dashboard']
      } as BreadcrumbItem,
      {
        label: this.resourceInfo?.pluralLabel || 'Resource',
        path: [`/resources/${this.resourceName}`]
      } as BreadcrumbItem,
      {
        label: 'Edit ' + this.resourceInfo?.label || 'Resource',
        path: [`/resources/${this.resourceName}`]
      } as BreadcrumbItem
    ]);
    this.breadcrumbService.update();
  }

  generatePdf(): void {
    if (this.resourceId) {
      this.resourcesService.startProcessing(this.resourceId, this.languageControl.value).toPromise().then((data: any) => {
        this.isProcessing = true;
        this.canDownload = false;
      });
    }
  }

  download(): void {
    window.open(this.downloadUrl,'_blank');
  }

  preview(): void {
    this.router.navigate(['/price-assign/preview', this.resourceId]);
  }

  ngOnDestroy(): void {
      this.poll$?.unsubscribe();
  }
}
