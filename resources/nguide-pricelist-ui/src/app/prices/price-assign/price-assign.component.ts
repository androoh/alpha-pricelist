import {Component, OnInit} from '@angular/core';
import {FormGroup} from '@angular/forms';
import {FormlyFieldConfig, FormlyFormOptions} from '@ngx-formly/core';
import {ResourceListListResponse, ResourcesService} from '../../shared/services/resources.service';
import {map} from 'rxjs/operators';
import {PRICE_LIST_RESOURCE_NAME, PricesResponse, PricesResult, PricesService} from '../services/prices.service';
import {AlertsService, AlertType} from '../../shared/services/alerts.service';
import {ActivatedRoute} from '@angular/router';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';

@Component({
  selector: 'app-price-assign',
  templateUrl: './price-assign.component.html',
  styleUrls: ['./price-assign.component.scss']
})
export class PriceAssignComponent implements OnInit {

  priceLists: PricesResult[] = [];
  pricesModel: any = {};
  priceListId: string | null = null;
  defaultLocale: string = 'nl';

  constructor(private resourcesService: ResourcesService,
              private activatedRoute: ActivatedRoute,
              private pricesService: PricesService,
              private breadcrumbService: BreadcrumbService,
              private alertsService: AlertsService) {

  }

  ngOnInit(): void {
    this.activatedRoute.paramMap.subscribe(params => {
      this.priceListId = params.get('id');
      if (this.priceListId) {
        this.initBreadcrumb();
        this.loadData(this.priceListId);
      }
    });

  }

  loadData(priceListId: string) {
    this.pricesService.getPriceListProductModelsAndOptions(priceListId).subscribe((priceLists: PricesResponse) => {
      this.priceLists = priceLists.data;
      this.defaultLocale = priceLists.defaultLocale;
      for (let item of this.priceLists) {
        this.pricesModel[item.id] = item.price;
      }
    });
  }

  submit() {
    if (this.priceListId) {
      console.log(this.pricesModel);
      this.pricesService.savePrices(this.priceListId, this.pricesModel).subscribe((result: any) => {
        this.alertsService.show(AlertType.success, 'Prices updated!');
      });
    }
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
        label: 'Assign Prices',
        path: [`/price-assign/${this.priceListId}`]
      } as BreadcrumbItem
    ]);
    this.breadcrumbService.update();
  }
}
