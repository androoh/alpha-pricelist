import {Component, EventEmitter, OnInit} from '@angular/core';
import {FormArray, FormControl} from '@angular/forms';
import {BsModalRef} from 'ngx-bootstrap/modal';
import {SelectionType} from '@swimlane/ngx-datatable';
import {ResourceListListResponse, ResourcesService, TableRequestData} from '../../../services/resources.service';
import {TableService} from '../../../services/table.service';
import {Table} from '../../../libs/table';
import {debounceTime, distinctUntilChanged} from 'rxjs/operators';
import {BehaviorSubject} from 'rxjs';


@Component({
  selector: 'app-add-new-modal',
  templateUrl: './add-new-modal.component.html',
  styleUrls: ['./add-new-modal.component.scss']
})
export class AddNewModalComponent extends Table implements OnInit {
  to: any;
  field: any;
  formControl: FormArray = new FormArray([]);
  SelectionType = SelectionType;
  selected: any = [];
  filter: any = {};
  searchControl: FormControl = new FormControl();
  public resourceName: string | null = null;
  public loadingIndicator = true;
  public listResponse: ResourceListListResponse | null = null;
  public onAddData: BehaviorSubject<any> = new BehaviorSubject<any>([]);

  constructor(public bsModalRef: BsModalRef, public resourcesService: ResourcesService, public tableService: TableService) {
    super(resourcesService, tableService);
  }

  ngOnInit(): void {
    this.resourceName = this.field?.templateOptions?.resource || null;
    const filter: { column: string; value: any; comparator: string; } | any = this.field?.templateOptions?.filter || null;
    const searchBy: string[] = this.field?.templateOptions?.searchBy || [];
    const filters: any = {};
    if (filter) {
      filters[filter.column] = filter.value;
    }
    if (this.resourceName) {
      this.loadData(this.resourceName, new TableRequestData({
        resource: this.resourceName,
        filters
      }));
    }
    this.searchControl.valueChanges
      .pipe(
        debounceTime(700),
        distinctUntilChanged()
      )
      .subscribe((value: any) => {
        if (this.resourceName && filters) {
          let filter: any = {};
          let searchByExp: any = [];
          for (let searchByKey of searchBy) {
            let exp: any = {};
            exp[searchByKey] = { '$regex' : '.*' + value + '.*'};
            searchByExp.push(exp);
          }
          filter['$or'] = searchByExp;
          this.onFilter(filter, true);
        }
      });
  }

  public addItems(): void {
    const toAdd = [];
    const currentValue = this.formControl.value || [];
    let index = currentValue.length;
    for (let selectedItem of this.selected) {
      const exists = currentValue.find((item: any) => {
        return item.id === selectedItem.id
      });
      if (exists === undefined) {
        const itemToSave: any = {
          id: selectedItem.id,
          order: index++,
          resource: this.resourceName
        };
        toAdd.push(itemToSave);
      }
    }
    this.onAddData.next(toAdd);
    this.bsModalRef.hide();
  }

  public onSelect(item: any): void {
    this.selected = item.selected;
  }

  public search(text: string): void {

  }
}
