import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/internal/Observable';
import { environment } from 'src/environments/environment';


export class TranslationsResponse {
  defaultLocale: string;
  locales: any;
  translations: {_id: string; group: string; key: string; text: any}[];

  constructor(props?: any) {
    this.defaultLocale = props?.defaultLocale ?? '';
    this.locales = props?.locales ?? {};
    this.translations = props?.translations ?? [];
  }
}


@Injectable({
  providedIn: 'root'
})
export class TranslationsService {

  constructor(private http: HttpClient) { }

  getTranslations(): Observable<TranslationsResponse> {
    return this.http.get<TranslationsResponse>(environment.apiBaseURL + 'translations');
  }

  saveTranslations(translations: {_id: string; group: string; key: string; text: any}[], translationsDelete: {_id: string; group: string; key: string; text: any}[]): Observable<any> {
    return this.http.put(environment.apiBaseURL + 'translations', {translations, translationsDelete});
  }
}
