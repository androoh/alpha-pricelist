import {Injectable} from '@angular/core';
import {BehaviorSubject, Observable, of, Subscription} from 'rxjs';
import {FieldsService} from '../../resources/services/fields.service';
import {HttpClient, HttpParams} from '@angular/common/http';
import {environment} from '../../../environments/environment';
import {FormlyFieldConfig} from '@ngx-formly/core';
import {map, switchMap} from 'rxjs/operators';

export class ResourceListListResponse {
  columns: Column[];
  sort: { sortBy: string; sortDir: string };
  current_page: number;
  data: any[];
  filters: any;
  first_page_url: string;
  from: number;
  last_apge: number;
  last_pate_url: string;
  links: any[];
  next_page_url: string;
  path: string;
  per_page: number;
  prev_page_url: string;
  to: number;
  total: number;
  defaultLocale: string;

  constructor(props?: any) {
    this.columns = props?.columns ?? null;
    this.current_page = props?.current_page ?? null;
    this.data = props?.data ?? null;
    this.first_page_url = props?.first_page_url ?? null;
    this.from = props?.from ?? null;
    this.last_apge = props?.last_apge ?? null;
    this.last_pate_url = props?.last_pate_url ?? null;
    this.links = props?.links ?? null;
    this.next_page_url = props?.next_page_url ?? null;
    this.path = props?.path ?? null;
    this.per_page = props?.per_page ?? null;
    this.prev_page_url = props?.prev_page_url ?? null;
    this.to = props?.to ?? null;
    this.filters = props?.filters ?? {};
    this.total = props?.total ?? null;
    this.sort = props?.sort ?? null;
    this.defaultLocale = props?.defaultLocale ?? 'nl';
  }
}

export class Column {
  key: string;
  path: string[];
  templateOptions: any;
  type: string;

  constructor(props?: any) {
    this.key = props?.key ?? '';
    this.path = props?.path ?? '';
    this.templateOptions = props?.templateOptions ?? '';
    this.type = props?.type ?? null;
  }
}

export class ResourcesResponse {
  icon: string;
  label: string;
  pluralLabel: string;
  name: string;
  searchBy: string;

  constructor(props?: any) {
    this.icon = props?.icon ?? '';
    this.label = props?.label ?? '';
    this.name = props?.name ?? '';
    this.pluralLabel = props?.pluralLabel ?? '';
    this.searchBy = props?.searchBy ?? null;
  }
}

export class CreateEditResponse {
  schema: any;
  data: any;
  locales: any;
  defaultLocale: string;

  constructor(props?: any) {
    this.schema = props?.schema ?? '';
    this.data = props?.data ?? '';
    this.locales = props?.locales ?? {};
    this.defaultLocale = props?.defaultLocale ?? 'nl';
  }
}

export class TableRequestData {
  resource: string;
  sorting: { sortBy: string; sortDir: string; } | null;
  page: number;
  filters?: { [key: string]: any };
  resourceIds?: string;
  searchBy?: { [key: string]: any };

  constructor(props?: any) {
    this.resource = props?.resource || null;
    this.sorting = props?.sorting || null;
    this.page = props?.page || 0;
    this.filters = props?.filters || null;
    this.searchBy = props?.searchBy || null;

    this.resourceIds = props?.resourceIds || null;
  }
}

@Injectable({
  providedIn: 'root'
})
export class ResourcesService {

  subscriptions: Subscription[] = [];

  currentResource: ResourcesResponse | null = null;

  onTableData: BehaviorSubject<TableRequestData | null> = new BehaviorSubject<TableRequestData | null>(null);

  resourceList: BehaviorSubject<ResourceListListResponse> = new BehaviorSubject<ResourceListListResponse>(new ResourceListListResponse());

  constructor(private fieldService: FieldsService, private http: HttpClient) {
    this.subscriptions.push(
      this.onTableData
        .pipe(
          switchMap((data: TableRequestData | null) => {
            if (data) {
              return this.getResourceList(data);
            }
            return of(null)
          })
        ).subscribe((listResponse: ResourceListListResponse | null) => {
        if (listResponse) {
          this.resourceList.next(listResponse);
        }
      }));
  }

  setCurrentResource(resource: ResourcesResponse): void {
    this.currentResource = resource;
  }

  getCurrentResource(): ResourcesResponse | null {
    return this.currentResource;
  }

  getResources(): Observable<ResourcesResponse[]> {
    return this.http.get<ResourcesResponse[]>(environment.apiBaseURL + 'resources');
  }

  getResourceInfo(resourceName: string): Observable<ResourcesResponse> {
    return this.http.get<ResourcesResponse>(environment.apiBaseURL + 'resources/' + resourceName + '/info');
  }

  getResourceList(data: TableRequestData): Observable<ResourceListListResponse> {
    let params = (new HttpParams()).set('page', data.page);
    if (data?.sorting) {
      params = params.set('sortBy', data.sorting.sortBy);
      params = params.set('sortDir', data.sorting.sortDir);
    }
    if (data?.filters) {
      params = params.set('filters', JSON.stringify(data.filters));
    }
    if (data?.resourceIds) {
      params = params.set('resourceIds', data.resourceIds);
    }
    return this.http.get<ResourceListListResponse>(environment.apiBaseURL + 'resources/' + data.resource + '/list', {params});
  }

  getPriceListTemplate(url: string): Observable<any> {
    return this.http.get(url, {responseType: 'text'});
  }

  // loadResources(resource: string, sorting: { sortBy: string; sortDir: string; } | null = null, page: number = 0, filters: { [key: string]: any } = {}): void {
  //   console.log('ok');
  //   of(0).pipe(
  //     switchMap((event) => this.getResourceList(resource, sorting, page, filters))
  //   ).subscribe((listResponse: ResourceListListResponse) => {
  //     console.log('obana');
  //     // this.resourceList.next(listResponse);
  //   })
  //   // this.getResourceList(resource, sorting, page, filters).toPromise().then((listResponse: ResourceListListResponse) => {
  //   //   this.resourceList.next(listResponse);
  //   // });
  // }

  getCreateResourceSchema(resource: string): Observable<CreateEditResponse> {
    return this.http.get<CreateEditResponse>(environment.apiBaseURL + 'resources/' + resource);
  }

  getEditResourceSchema(resource: string, id: string): Observable<CreateEditResponse> {
    return this.http.get<CreateEditResponse>(environment.apiBaseURL + 'resources/' + resource + '/' + id);
  }

  createResource(resource: string, data: any): Observable<CreateEditResponse> {
    return this.http.post<CreateEditResponse>(environment.apiBaseURL + 'resources/' + resource, data);
  }

  updateResource(resource: string, id: string, data: any): Observable<CreateEditResponse> {
    return this.http.put<CreateEditResponse>(environment.apiBaseURL + 'resources/' + resource + '/' + id, data);
  }

  removeResource(resource: string, id: string): Observable<any> {
    return this.http.delete<any>(environment.apiBaseURL + 'resources/' + resource + '/' + id);
  }

  getHtml(): Observable<any> {
    return this.http.get(environment.apiBaseURL + 'html', {responseType: 'text'});
  }

  getFilters(resourceName: string): Observable<any[]> {
    return this.http.get<any[]>(environment.apiBaseURL + 'resources/' + resourceName + '/filters').pipe(map((fields: any[]) => {
      if (fields) {
        for (let field of fields) {
          if (field.templateOptions?.required !== undefined && field.templateOptions?.required === true) {
            field.templateOptions.required = false;
          }
        }
      }
      return fields;
    }));
  }

  getFieldById(id: string, fields: FormlyFieldConfig[]): any {
    return fields.find((item: any) => item.key === id);
  }

  getFilterableOptions(data: any, fields: any[]): any {
    let filterObject: any = {};
    for (const key in data) {
      if (data.hasOwnProperty(key) && data[key] && fields) {
        const field = this.getFieldById(key, fields);
        filterObject[field?.path || key] = data[key];
      }
    }
    return filterObject;
  }

  nrNonEmptyFilters(filter: any): number {
    let nr = 0;
    if (filter) {
      for (const key in filter) {
        if (filter.hasOwnProperty(key) && filter[key]) {
          nr++;
        }
      }
    }
    return nr;
  }

  clear(): void {
    this.subscriptions.forEach((subscription: Subscription) => subscription.unsubscribe());
  }
}
