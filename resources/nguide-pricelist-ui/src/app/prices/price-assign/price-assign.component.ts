import {Component, OnInit} from '@angular/core';
import {ResourcesService} from '../../shared/services/resources.service';
import {PricesResponse, PricesResult, PricesService} from '../services/prices.service';
import {AlertsService, AlertType} from '../../shared/services/alerts.service';
import {ActivatedRoute} from '@angular/router';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';
import { BsModalRef, BsModalService } from 'ngx-bootstrap/modal';
import { ModifyPriceComponent, PriceModifier } from './modify-price/modify-price.component';

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
  bsModalRef: BsModalRef;

  constructor(private resourcesService: ResourcesService,
              private modalService: BsModalService,
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
            selected: boolean;
            delivery_price: number | string;
            installation_price: number | string;
            delivery_price_on_demand: boolean;
            installation_price_on_demand: boolean;
          } = {
            selected: false,
            delivery_price: item.price?.delivery_price || 0,
            installation_price: item.price?.installation_price || 0,
            delivery_price_on_demand: item.price?.delivery_price_on_demand || false,
            installation_price_on_demand: item.price?.installation_price_on_demand || false
          };
          this.pricesModel[item.id] = price;
        } else {
          const price: {value: number | string; onDemand: boolean; selected: boolean;} = {
            selected: false,
            value: item.price?.value || 0,
            onDemand: item.price?.onDemand || false
          };
          this.pricesModel[item.id] = price;
        }
      }
    });
  }

  selectAll(data: any): void {
    for (const itemId in this.pricesModel) {
      if (this.pricesModel.hasOwnProperty(itemId)) {
        this.pricesModel[itemId].selected = data.target.checked;
      }
    }
  }

  modifyPrices(): void {
    this.bsModalRef = this.modalService.show(ModifyPriceComponent, {initialState: {}, class: 'modal-lg'});
    this.bsModalRef.content.priceModifier.subscribe((modifier: PriceModifier) => {
      if (modifier) {
        for (const itemId in this.pricesModel) {
          if (this.pricesModel.hasOwnProperty(itemId) && this.pricesModel[itemId].selected) {
            if (this.pricesModel[itemId].hasOwnProperty('delivery_price') || this.pricesModel[itemId].hasOwnProperty('installation_price')) {
              this.pricesModel[itemId].delivery_price = this.applyModifier(Number(this.pricesModel[itemId].delivery_price), modifier);
              this.pricesModel[itemId].installation_price = this.applyModifier(Number(this.pricesModel[itemId].installation_price), modifier);
            } else {
              this.pricesModel[itemId].value = this.applyModifier(Number(this.pricesModel[itemId].value), modifier);
            }
          }
        }
        this.bsModalRef.hide();
      }
    });
  }

  applyModifier(value: number, modifier: PriceModifier): number {
    let modifierValue = Number(modifier.value);
    if (modifier.valueType === '%') {
      modifierValue = modifierValue * value / 100;
    }
    if (modifier.type === 'discount') {
      value -= modifierValue;
    } else {
      value += modifierValue;
    }
    value = Math.round(value);
    if (value >= 100) {
      if (value % 10 > 5) {
        value = Math.round(value / 10) * 10;
      } else if (value % 10 < 5) {
        value = Math.round(value / 5) * 5;
      }
    }
    return value < 0 ? 0 : value;
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
