import { Component } from '@angular/core';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { BehaviorSubject } from 'rxjs';

export interface PriceModifier {
  type: 'increase' | 'discount';
  value: number;
  valueType: '%' | 'value';
}

@Component({
  selector: 'app-modify-price',
  templateUrl: './modify-price.component.html',
  styleUrls: ['./modify-price.component.scss']
})
export class ModifyPriceComponent {
  selectedPriceModifier: PriceModifier = {type: 'discount', value: 0, valueType: '%'};
  priceModifier: BehaviorSubject<PriceModifier | null> = new BehaviorSubject<PriceModifier | null>(null);

  constructor(public bsModalRef: BsModalRef) { }

  modifyPrices(): void {
    this.priceModifier.next(this.selectedPriceModifier);
  }
}
