import {ChangeDetectorRef, Component, OnDestroy, OnInit} from '@angular/core';
import {FieldType, FormlyFieldConfig} from '@ngx-formly/core';
import {ColumnMode} from '@swimlane/ngx-datatable';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import {environment} from '../../../../environments/environment';
import {Table} from '../../libs/table';
import {ResourceListListResponse, ResourcesService, TableRequestData} from '../../services/resources.service';
import {TableService} from '../../services/table.service';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import {get} from 'lodash';
import {AddNewModalComponent} from "../has-many/add-new-modal/add-new-modal.component";
import {FormGroup} from "@angular/forms";
import {Subscription} from "rxjs";

@Component({
  selector: 'app-has-many',
  templateUrl: './has-many-cascade.component.html',
  providers: [
    TableService,
    ResourcesService,
  ],
  styleUrls: ['./has-many-cascade.component.scss']
})
export class HasManyCascadeComponent extends FieldType implements OnInit, OnDestroy {
  private bsModalRef: BsModalRef | null = null;
  private subscriptions: Subscription[] = [];
  public table: Table;
  public resourceName: string | null = null;
  public rows: any[] = [];
  public sorting: { sortBy: string; sortDir: string } = {sortBy: 'order', sortDir: 'asc'};

  public formGroup: FormGroup = new FormGroup({});
  public expandedSections: any = {};

  defaultLocale = environment.defaultLocale;

  constructor(
    private changeRef: ChangeDetectorRef,
    private modalService: BsModalService,
    private resourcesService: ResourcesService,
    private tableService: TableService
  ) {
    super();
    this.table = new Table(resourcesService, tableService);
  }

  ngOnInit(): void {
    this.resourceName = this.to?.main?.resource || null;
    this.table.resourceName = this.resourceName;
    this.defaultLocale = this.to?.defaultLocale || environment.defaultLocale;
    this.loadTable(this.formControl.value || [], this.table, this.to?.main?.resource, this.sorting);
    this.subscriptions.push(
      this.formControl.valueChanges.subscribe((value) => {
        this.loadTable(value, this.table, this.to?.main?.resource, this.sorting);
      }));
    this.subscriptions.push(
      this.table.onLoaded.subscribe((result: ResourceListListResponse | null) => {
        if (result) {
          this.changeRef.detectChanges();
        }
      }));
  }

  loadTable(value: any[], table: Table, resourceName: string, sorting: any): void {
    if (value && value.length > 0) {
      value = value.sort((a, b) => {
        const orderA = a?.order || 0;
        const orderB = b?.order || 0;
        if (orderA < orderB) {
          return -1;
        }
        if (orderA > orderB) {
          return 1;
        }
        return 0;
      });
      const resourceIds = [];
      for (const row of value) {
        resourceIds.push(row.id);
      }
      const resourceIdsJoined = resourceIds.join(',');
      if (resourceName && table) {
        table.loadData(resourceName, new TableRequestData({
          resource: resourceName,
          resourceIds: resourceIdsJoined.length > 0 ? resourceIdsJoined : 'empty',
          sorting: sorting
        }));
      }
    }
  }

  remove(id: any): void {
    const newValue = this.formControl.value.filter((row: any) => row.id !== id);
    this.formControl.setValue(newValue);
  }

  get columnMode(): string {
    return ColumnMode.flex;
  }

  getHasManyFields(id: any): FormlyFieldConfig[] {
    return [{
      'key': 'children',
      'type': 'hasMany',
      'templateOptions': {
        'label': this.to?.child?.label,
        'resource': this.to?.child?.resource,
        'searchBy': this.to?.child?.searchBy,
        'hideDragHandle': true,
        'filter': [
          this.to?.child?.filter,
          {
            'column': this.to?.child?.relationKey,
            'comparator': '=',
            'value': id
          }
        ]
      }
    }];
  }

  openModalWithComponent(): void {
    const initialState: Partial<any> = {
      resourceName: this.to?.main?.resource || null,
      filter: null,
      searchBy: this.to?.main?.searchBy || null,
      formControl: this.formControl
    };
    const currentValue = this.formControl.value || [];
    this.bsModalRef = this.modalService.show(AddNewModalComponent, {initialState, class: 'modal-lg'});
    this.bsModalRef.content.onAddData.subscribe((toAdd: any) => {
      this.formControl.setValue([...currentValue, ...toAdd]);
    })
  }

  drop(event: CdkDragDrop<string[]>) {
    moveItemInArray(this.table.rows, event.previousIndex, event.currentIndex);
    const currentValues = this.formControl.value.map((item: any) => {
      const order = this.table.rows.findIndex((itm: any) => itm.id === item.id);
      if (order !== -1) {
        item['order'] = order;
      } else {
        item['order'] = 0;
      }
      return item;
    });
    this.formControl.setValue(currentValues, {emitEvent: false});
  }

  getValue(obj: any, path: string): any {
    return get(obj, path);
  }

  childChanges(value: any, id: any): void {
    if (value && value?.children && value?.children.length > 0) {
      const currentValue: any[] = this.formControl.value || [];
      const resourceById: any = currentValue.find((item: any) => item.id === id);
      if (resourceById !== undefined) {
        resourceById.children = value?.children;
      }
      this.formControl.setValue(currentValue, {emitEvent: false});
    }
  }

  getModel(id: string): any {
    const model = this.formControl.value.find((value: any) => value.id === id);
    if (model !== undefined && !model.hasOwnProperty('children')) {
      model['children'] = [];
    }
    return model !== undefined ? model : {};
  }

  isExpanded(id: string): boolean {
    if (!this.expandedSections.hasOwnProperty(id)) {
      this.expandedSections[id] = false;
    }
    return this.expandedSections[id];
  }

  expand(id: string): void {
    if (!this.expandedSections.hasOwnProperty(id)) {
      this.expandedSections[id] = false;
    }
    for (const itemKey in this.expandedSections) {
      if (this.expandedSections.hasOwnProperty(itemKey) && itemKey !== id) {
        this.expandedSections[itemKey] = false;
      }
    }
    this.expandedSections[id] = this.expandedSections[id] === false;
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }
}
