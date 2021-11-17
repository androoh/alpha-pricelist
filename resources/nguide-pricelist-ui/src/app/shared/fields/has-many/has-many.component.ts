import {ChangeDetectionStrategy, ChangeDetectorRef, Component, OnDestroy, OnInit} from '@angular/core';
import {FieldType} from '@ngx-formly/core';
import {ColumnMode} from '@swimlane/ngx-datatable';
import {AddNewModalComponent} from './add-new-modal/add-new-modal.component';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import {environment} from '../../../../environments/environment';
import {Table} from '../../libs/table';
import {ResourceListListResponse, ResourcesService, TableRequestData} from '../../services/resources.service';
import {TableService} from '../../services/table.service';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import {get} from 'lodash';
import {Subscription} from "rxjs";

@Component({
  selector: 'app-has-many',
  templateUrl: './has-many.component.html',
  providers: [TableService, ResourcesService],
  styleUrls: ['./has-many.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class HasManyComponent extends FieldType implements OnInit, OnDestroy {
  private bsModalRef: BsModalRef | null = null;
  public table: Table;
  public resourceName: string | null = null;
  public sorting: { sortBy: string; sortDir: string } = {sortBy: 'order', sortDir: 'asc'};
  private subscriptions: Subscription[] = [];

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
    this.resourceName = this.to?.resource || null;
    this.table.resourceName = this.resourceName;
    this.defaultLocale = this.to?.defaultLocale || environment.defaultLocale;
    this.loadTable(this.formControl.value || []);
    this.subscriptions.push(
      this.formControl.valueChanges.subscribe((value) => {
        this.loadTable(value);
      }));
    this.subscriptions.push(
      this.table.onLoaded.subscribe((result: ResourceListListResponse | null) => {
        if (result) {
          this.changeRef.detectChanges();
        }
      }));
  }

  loadTable(value: any[]): void {
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
      if (this.resourceName) {
        this.table.loadData(this.resourceName, new TableRequestData({
          resource: this.resourceName,
          resourceIds: resourceIdsJoined.length > 0 ? resourceIdsJoined : 'empty',
          sorting: this.sorting
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


  openModalWithComponent() {
    const initialState: Partial<any> = {
      resourceName: this.resourceName,
      filter: this.to?.filter || null,
      searchBy: this.to?.searchBy || null,
      formControl: this.formControl
    };
    const currentValue = this.formControl.value || [];
    this.bsModalRef = this.modalService.show(AddNewModalComponent, {initialState, class: 'modal-lg'});
    this.bsModalRef.content.onAddData.subscribe((toAdd: any) => {
      this.formControl.setValue([...currentValue, ...toAdd]);
    });
  }

  drop(event: CdkDragDrop<string[]>) {
    this.moveItem(event.previousIndex, event.currentIndex);
  }

  moveItem(previousIndex: number, currentIndex: number): void {
    moveItemInArray(this.table.rows, previousIndex, currentIndex);
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

  moveUp(currentIndex: number): void {
    if (currentIndex - 1 >= 0) {
      this.moveItem(currentIndex, currentIndex - 1);
    }
  }

  moveDown(currentIndex: number): void {
    if (currentIndex + 1 < this.table.rows.length) {
      this.moveItem(currentIndex, currentIndex + 1);
    }
  }

  getValue(obj: any, path: string): any {
    return get(obj, path);
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }
}
