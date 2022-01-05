import {
  AfterViewInit,
  ChangeDetectionStrategy,
  ChangeDetectorRef,
  Component,
  ElementRef,
  OnInit,
  ViewChild
} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {DomSanitizer, SafeResourceUrl} from '@angular/platform-browser';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';
import {CreateEditResponse, ResourcesResponse, ResourcesService} from '../../shared/services/resources.service';
import {FormControl, FormGroup} from '@angular/forms';
import {environment} from '../../../environments/environment';
import { saveAs } from 'file-saver';

@Component({
  selector: 'app-preview',
  templateUrl: './preview.component.html',
  styleUrls: ['./preview.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class PreviewComponent implements OnInit {
  @ViewChild('iframe') iframe: ElementRef;
  private priceListId: string | null = null;
  private resourceName = 'priceList';
  private templateUrl = '';
  iframeLoaded = false;
  locales: any[] = [];
  defaultLocale = 'nl';
  resourceInfo: ResourcesResponse | null = null;
  pageSizes = [
    'A0',
    'A1',
    'A2',
    'A3',
    'A4',
    'A5',
    'A6',
    'A7',
    'A10',
    'B4',
    'B5',
    'letter',
    'legal',
    'ledger'
  ];
  pageOrientations = [
    'portrait',
    'landscape'
  ]
  model: any = {};
  form: FormGroup = new FormGroup({
    'locale': new FormControl(''),
    'pageSize': new FormControl('A4'),
    'showCropBorders': new FormControl(false),
    'showCross': new FormControl(false),
    'pageOrientation': new FormControl('portrait')
  });

  constructor(
    private ref: ChangeDetectorRef,
    private activatedRoute: ActivatedRoute,
    private sanitizer: DomSanitizer,
    private breadcrumbService: BreadcrumbService,
    private resourcesService: ResourcesService
  ) {
  }

  ngOnInit(): void {
    this.activatedRoute.paramMap.subscribe(params => {
      this.priceListId = params.get('id');
      if (this.resourceName) {
        this.resourcesService.getResourceInfo(this.resourceName).subscribe((resourceInfo: ResourcesResponse) => {
          this.resourceInfo = resourceInfo;
          this.initBreadcrumb();
          if (this.priceListId) {
            this.resourcesService.getEditResourceSchema(this.resourceName, this.priceListId).subscribe((response: CreateEditResponse) => {
              this.defaultLocale = response.defaultLocale;
              this.form.get('locale')?.setValue(this.defaultLocale);
              this.model = response.data;
              this.locales = this.mapLocales(response.locales, this.model?.language || []);
            });
          }
        });
      }
    });
    this.form.valueChanges.subscribe((data: any) => {
      if (data) {
        const parameters = {
          locale: data?.locale || 'nl',
          pageSize: data?.pageSize || 'A4',
          showCropBorders: data?.showCropBorders || false,
          showCross: data?.showCross || false,
          pageOrientation: data?.pageOrientation || 'portrait'
        };
        this.updateTemplateUrl(parameters);
      }
    });
  }

  updateTemplateUrl(parameters: any): void {
    const options = [];
    this.iframeLoaded = false;
    for (const key in parameters) {
      options.push(key + '=' + parameters[key]);
    }
    this.ref.reattach();
    this.templateUrl = environment.apiBaseURL + 'html?' + options.join('&');
  }


  getPreviewURL(): SafeResourceUrl {
    const url = this.sanitizer.bypassSecurityTrustResourceUrl(this.templateUrl);
    if (this.templateUrl) {
      this.ref.detach();
    }
    return url;
  }

  mapLocales(locales: any, availableLanguages: string[]): any[] {
    const result: any[] = [];
    for (const localeKey in locales) {
      if (availableLanguages.includes(localeKey)) {
        result.push({
          key: localeKey,
          value: locales[localeKey]
        });
      }
    }
    return result;
  }

  initBreadcrumb(): void {
    this.breadcrumbService.setBreadcrumb([
      {
        label: 'Home',
        path: ['/dashboard']
      } as BreadcrumbItem,
      {
        label: 'Price lists',
        path: [`/resources/priceList`]
      } as BreadcrumbItem,
      {
        label: 'Edit Price list',
        path: [`/resources/priceList/${this.priceListId}/edit`]
      } as BreadcrumbItem,
      {
        label: 'Preview Price List',
        path: [`/price-assign/preview/${this.priceListId}`]
      } as BreadcrumbItem
    ]);
    this.breadcrumbService.update();
  }

  print(): void {
    window.open(this.templateUrl, "_blank");
  }

  setIframeLoaded(): void {

  }

}
