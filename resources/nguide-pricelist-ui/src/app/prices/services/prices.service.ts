import { Injectable } from '@angular/core';
import {Observable} from 'rxjs';
import {environment} from '../../../environments/environment';
import {HttpClient} from '@angular/common/http';

export const PRICE_LIST_RESOURCE_NAME = 'priceList';

export interface PricesResult {
  id: string;
  name: string;
  sku: string;
  type: string;
  price: any;
}

export interface PricesResponse {
  data: PricesResult[];
  defaultLocale: string;
}

@Injectable({
  providedIn: 'root'
})
export class PricesService {

  constructor(private http: HttpClient) { }

  getPriceListProductModelsAndOptions(priceListId: string): Observable<PricesResponse> {
    return this.http.get<PricesResponse>(environment.apiBaseURL + 'prices/' + priceListId);
  }

  savePrices(priceListId: string, prices: {[key: string]: number}[]): Observable<PricesResult[]> {
    return this.http.put<PricesResult[]>(environment.apiBaseURL + 'prices/' + priceListId, {prices});
  }
}
