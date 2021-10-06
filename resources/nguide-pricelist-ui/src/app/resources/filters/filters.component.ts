import {Component, EventEmitter, Input, OnChanges, OnInit, Output, SimpleChanges} from '@angular/core';
import {ResourcesService} from '../../shared/services/resources.service';
import {FormGroup} from '@angular/forms';
import {FormlyFieldConfig, FormlyFormOptions} from '@ngx-formly/core';
import {debounceTime, distinctUntilChanged, filter} from 'rxjs/operators';

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
      this.resourcesService.getFilters(changes.resourceName.currentValue).subscribe((filters: any[]) => {
        this.fields = filters;
      });
    }
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
