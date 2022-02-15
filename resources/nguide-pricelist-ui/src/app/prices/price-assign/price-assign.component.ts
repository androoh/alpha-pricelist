import {Component, OnInit} from '@angular/core';
import {ResourcesService} from '../../shared/services/resources.service';
import {PricesResponse, PricesResult, PricesService} from '../services/prices.service';
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
        if (item.type === 'product_main') {
          const price: {
            delivery_price: number | string;
            installation_price: number | string;
            delivery_price_on_demand: boolean;
            installation_price_on_demand: boolean;
          } = {
            delivery_price: item.price?.delivery_price || 0,
            installation_price: item.price?.installation_price || 0,
            delivery_price_on_demand: item.price?.delivery_price_on_demand || false,
            installation_price_on_demand: item.price?.installation_price_on_demand || false
          };
          this.pricesModel[item.id] = price;
        } else {
          const price: {value: number | string; onDemand: boolean} = {
            value: item.price?.value || 0,
            onDemand: item.price?.onDemand || false
          };
          this.pricesModel[item.id] = price;
        }
      }
    });
  }

  submit() {
    if (this.priceListId) {
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
