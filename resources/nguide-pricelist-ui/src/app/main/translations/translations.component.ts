import { Component, OnInit } from '@angular/core';
import { AlertsService, AlertType } from 'src/app/shared/services/alerts.service';
import { BreadcrumbService } from 'src/app/shared/services/breadcrumb.service';
import { TranslationsResponse, TranslationsService } from '../services/translations.service';

@Component({
  selector: 'app-translations',
  templateUrl: './translations.component.html',
  styleUrls: ['./translations.component.scss']
})
export class TranslationsComponent implements OnInit {
  public defaultLocale: string = 'en';
  public locales: any[] = [];
  public translations: {_id: string; group: string; key: string; text: any}[] = [];
  public translationsDelete: {_id: string; group: string; key: string; text: any}[] = [];

  constructor(private breadcrumbService: BreadcrumbService, private translationsService: TranslationsService, private alertsService: AlertsService) { }

  ngOnInit(): void {
    this.initBreadcrumb();
    this.getTranslations();
  }

  getTranslations(): void {
    this.translationsDelete = [];
    this.translationsService.getTranslations().subscribe((translationResults: TranslationsResponse) => {
      this.translations = translationResults.translations.map((translation: any) => {
        if (translation?.text && Array.isArray(translation.text)) {
          translation.text = {};
        }
        return translation;
      });
      this.defaultLocale = translationResults.defaultLocale;
      this.locales = this.mapLocales(translationResults.locales);
    });
  }

  initBreadcrumb(): void {
    this.breadcrumbService.clear();
  }

  mapLocales(locales: any): any[] {
    const result: any[] = [];
    for (const localeKey in locales) {
      result.push({
        key: localeKey,
        value: locales[localeKey]
      });
    }
    return result;
  }

  save(): void {
    for(let translation of this.translations) {
      if (!translation.key) {
        this.alertsService.show(AlertType.danger, 'Key is required!');
        return;
      }
    }
    this.translationsService.saveTranslations(this.translations, this.translationsDelete).subscribe((result: any) => {
      this.alertsService.show(AlertType.success, 'Translations updated!');
      this.getTranslations();
    });
  }

  add(): void {
    this.translations.push({
      _id: '',
      key: '',
      group: '*',
      text: {}
    });
  }

  remove(translation: any): void {
    this.translations = this.translations.filter((translationItem: any) => translationItem._id + translationItem.key  !== translation._id + translation.key);
    this.translationsDelete.push(translation);
  }
}
