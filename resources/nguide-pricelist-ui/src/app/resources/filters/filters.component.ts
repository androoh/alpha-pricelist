import {Component, EventEmitter, Input, OnChanges, OnInit, Output, SimpleChanges} from '@angular/core';
import {ResourcesService} from '../../shared/services/resources.service';
import {FormGroup} from '@angular/forms';
import {FormlyFieldConfig, FormlyFormOptions} from '@ngx-formly/core';
import {debounceTime, distinctUntilChanged, filter} from 'rxjs/operators';
import {BehaviorSubject} from 'rxjs';

@Component({
  selector: 'app-filters',
  templateUrl: './filters.component.html',
  styleUrls: ['./filters.component.scss']
})
export class FiltersComponent implements OnInit, OnChanges {

  @Input()
  resourceName: string = '';

  @Input()
  filters: any;
  @Output()
  filtersChange: EventEmitter<any> = new EventEmitter<any>();

  form: FormGroup = new FormGroup({});
  model: any = {};
  options: FormlyFormOptions = {};
  fields: FormlyFieldConfig[] | null = [];
  defaultLocale = 'nl';

  constructor(private resourcesService: ResourcesService) {
  }

  get nrFilters(): number {
    return this.resourcesService.nrNonEmptyFilters(this.form.value);
  }

  ngOnInit(): void {
    this.form.valueChanges
      .pipe(
        debounceTime(700),
        distinctUntilChanged()
      )
      .subscribe((value: any) => {
        if (value && this.fields) {
          this.filtersChange.emit(this.resourcesService.getFilterableOptions(value, this.fields));
        }
      })
  }


  ngOnChanges(changes: SimpleChanges): void {
    if (changes?.resourceName?.currentValue) {
      this.resourcesService.getFilters(changes.resourceName.currentValue).subscribe((response: {schema: any[]; defaultLocale: string}) => {
        this.defaultLocale = response.defaultLocale;
        this.fields = this.mapFields(response.schema, this.defaultLocale);
      });
    }
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

      if (f.type === 'translatable-input' || f.type === 'translatable-textarea') {
        if (!f.templateOptions?.language) {
          f.templateOptions.language = new BehaviorSubject(language);
        } else {
          f.templateOptions.language.next(language);
        }
        f.wrappers = [...(f.wrappers || []), 'translatable'];
      }
      f.templateOptions['defaultLocale'] = this.defaultLocale;
      return f;
    });
  }

  reset(): void {
    for (const key in this.model) {
      if (this.model.hasOwnProperty(key)) {
        this.model[key] = null;
      }
    }
    this.form.patchValue(this.model);
  }

  submit(): void {

  }

}
