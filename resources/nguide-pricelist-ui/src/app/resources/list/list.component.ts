import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {ResourcesResponse, ResourcesService, TableRequestData} from '../../shared/services/resources.service';
import {AlertsService, AlertType} from '../../shared/services/alerts.service';
import {TableService} from '../../shared/services/table.service';
import {Table} from '../../shared/libs/table';
import {combineLatest} from 'rxjs';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';

@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.scss']
})
export class ListComponent extends Table implements OnInit {

  resourceInfo: ResourcesResponse | undefined;

  constructor(private activatedRoute: ActivatedRoute,
              public resourcesService: ResourcesService,
              private alertsService: AlertsService,
              private breadcrumbService: BreadcrumbService,
              public tableService: TableService) {
    super(resourcesService, tableService);
  }

  ngOnInit(): void {
    combineLatest([
      this.activatedRoute.paramMap,
      this.activatedRoute.queryParamMap
    ])
      .subscribe(([params, queryParams]: any) => {
        this.resourceName = params.get('name');
        this.filtersData = JSON.parse(queryParams.get('filters', '{}'));
        if (this.resourceName) {
          this.resourcesService.getResourceInfo(this.resourceName).subscribe((resourceInfo: ResourcesResponse) => {
            this.resourceInfo = resourceInfo;
            this.initBreadcrumb();
            if (this.resourceName) {
              this.loadData(this.resourceName,
                new TableRequestData({
                  resource: this.resourceName,
                  filters: this.filtersData
                }));
            }
          });
        }
      });
  }

  filtersChange(filters: any): void {
    if (this.resourceName && filters) {
      this.onFilter(filters);
    }
  }

  public remove(id: string): void {
    if (confirm('Are you sure you want to remove this item?')) {
      if (this.resourceName) {
        this.resourcesService.removeResource(this.resourceName, id).subscribe((result: any) => {
          if (this.resourceName) {
            this.alertsService.show(AlertType.success, 'Resource Removed!');
            this.resourcesService.onTableData.next(new TableRequestData({
              resource: this.resourceName,
              sorting: this.sort,
              page: this.page,
              filters: this.filters
            }));
          }
        });
      }
    } else {
    }
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
      } as BreadcrumbItem
    ]);
    this.breadcrumbService.update();
  }

}
