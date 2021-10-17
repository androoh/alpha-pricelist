import {Component, OnInit} from '@angular/core';
import {FieldType} from '@ngx-formly/core';
import {ColumnMode} from '@swimlane/ngx-datatable';
import {AddNewModalComponent} from './add-new-modal/add-new-modal.component';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import {environment} from '../../../../environments/environment';
import {Table} from '../../libs/table';
import {ResourcesService, TableRequestData} from '../../services/resources.service';
import {TableService} from '../../services/table.service';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import {get} from 'lodash';

@Component({
  selector: 'app-has-many',
  templateUrl: './has-many.component.html',
  providers: [TableService, ResourcesService],
  styleUrls: ['./has-many.component.scss']
})
export class HasManyComponent extends FieldType implements OnInit {
  private bsModalRef: BsModalRef | null = null;
  public table: Table;
  public resourceName: string | null = null;
  public rows: any[] = [];
  public sorting: { sortBy: string; sortDir: string } = {sortBy: 'order', sortDir: 'asc'};

  defaultLocale = environment.defaultLocale;

  constructor(
    private modalService: BsModalService,
    private resourcesService: ResourcesService,
    private tableService: TableService
  ) {
    super();
    this.table = new Table(resourcesService, tableService);
  }

  ngOnInit(): void {
    this.resourceName = this.to?.resource || null;
    this.table.resourceName = this.resourceName;
    this.defaultLocale = this.to?.defaultLocale || environment.defaultLocale;
    this.loadTable(this.formControl.value || []);
    this.formControl.valueChanges.subscribe((value) => {
      this.loadTable(value);
    });
  }

  loadTable(value: any[]): void {
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
    if (this.resourceName) {
      this.table.loadData(this.resourceName, new TableRequestData({
        resource: this.resourceName,
        resourceIds: resourceIdsJoined.length > 0 ? resourceIdsJoined : 'empty',
        sorting: this.sorting
      }));
    }
  }

  remove(id: any): void {
    const newValue = this.formControl.value.filter((row: any) => row.id !== id);
    this.formControl.setValue(newValue);
  }

  get columnMode(): string {
    return ColumnMode.flex;
  }


  openModalWithComponent() {
    const initialState: Partial<any> = {
      to: this.to,
      field: this.field,
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
    this.formControl.setValue(currentValues, {emitEvent: false})
  }

  getValue(obj: any, path: string): any {
    return get(obj, path);
  }
}
