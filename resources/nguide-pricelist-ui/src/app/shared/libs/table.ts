import {ResourceListListResponse, ResourcesService, TableRequestData} from '../services/resources.service';
import {ColumnMode} from '@swimlane/ngx-datatable';
import {TableService} from '../services/table.service';

export class Table {

  public resourceName: string | null = '';
  public listResponse: ResourceListListResponse | null = null;
  public loadingIndicator = true;
  public rows: any[] = [];
  public columns: any[] = [];
  public filtersData: any = {};
  public defaultLocale = 'nl';

  constructor(public resourcesService: ResourcesService,
              public tableService: TableService) {
  }

  loadData(resourceName: string, tableData?: TableRequestData): void {
    this.resourcesService.resourceList.subscribe((result: ResourceListListResponse) => {
      if (result) {
        const {rows, columns} = this.tableService.mapRowsAndColumns(result);
        this.rows = rows;
        this.columns = columns;
        this.defaultLocale = result.defaultLocale;
        this.listResponse = result;
      }
      this.loadingIndicator = false;
    });
    if (tableData) {
      this.resourcesService.onTableData.next(new TableRequestData({
        resource: this.resourceName,
        resourceIds: tableData.resourceIds || null,
        filters: tableData.filters || this.filtersData,
        sorting: tableData.sorting || null
      }));
    }
  }

  get columnMode(): string {
    return ColumnMode.force;
  }

  public onSort(data: any): void {
    if (this.resourceName) {
      const sort = { sortBy: data.sorts[0].prop, sortDir: data.sorts[0].dir};
      this.resourcesService.onTableData.next(
        new TableRequestData({
          resource: this.resourceName,
          sorting: sort,
          page: this.page,
          filters: this.filters
        })
      );
    }
  }

  public get page(): number {
    return (this.listResponse && this.listResponse?.current_page) ? this.listResponse?.current_page : 0;
  }

  public get sort(): {sortBy: string; sortDir: string;} | null {
    return (this.listResponse && this.listResponse?.sort) ? this.listResponse?.sort : null;
  }

  public get filters(): any | null {
    return (this.listResponse && this.listResponse?.filters) ? this.listResponse.filters : null;
  }

  public onPaginate(data: any): void {
    if (this.resourceName) {
      const nextPage = (data?.offset !== null && data?.offset !== undefined) ? data?.offset + 1 : 1;
      this.resourcesService.onTableData.next(new TableRequestData({
        resource: this.resourceName,
        sorting: this.sort,
        page: nextPage,
        filters: this.filters
      }));
    }
  }

  public onFilter(filters: any, merge: boolean = false): void {
    if (this.resourceName) {
      this.resourcesService.onTableData.next(new TableRequestData({
        resource: this.resourceName,
        sorting: this.sort,
        page: this.page,
        filters: this.getFilterableOptions(merge ? {...this.filters, ...filters} : filters)
      }));
    }
  }

  getFilterableOptions(data: any): any {
    let filterObject: any = {};
    for (const key in data) {
      if (data.hasOwnProperty(key) && data[key]) {
        filterObject[key] = data[key];
      }
    }
    return filterObject;
  }

  getTranslatedValue(value: any): string {
    if (value.hasOwnProperty(this.defaultLocale)) {
      return value[this.defaultLocale];
    }
    return '';
  }

  get currentPage(): number {
    return this?.listResponse?.current_page ? this.listResponse.current_page - 1 : 0;
  }

  get total(): number {
    return this?.listResponse?.total ? this.listResponse.total : 0;
  }

  get perPage(): number {
    return this?.listResponse?.per_page ? this.listResponse.per_page : 0;
  }
}
