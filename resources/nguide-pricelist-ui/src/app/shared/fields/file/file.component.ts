import {Component, OnInit} from '@angular/core';
import {FieldType} from '@ngx-formly/core';
import {FileUploader} from 'ng2-file-upload';
import {DomSanitizer, SafeStyle} from '@angular/platform-browser';
import {HttpClient} from '@angular/common/http';
import {map} from 'rxjs/operators';
import {environment} from "../../../../environments/environment";
import { TranslatableType } from '../translatable-type';
import { requiredTranslated } from '../../directives/required-translated.directive';
import { FormControl } from '@angular/forms';

export const API_URL = '/api/files';
export const API_GET_FILE_URL = '/api/files/n/';

export interface ImageResponse {
  id: string;
  name: string;
  oldName: string;
  path: string;
  storage: string;
  url: string;
}

@Component({
  selector: 'app-file',
  templateUrl: './file.component.html',
  styleUrls: ['./file.component.scss']
})
export class FileComponent extends FieldType implements OnInit {
  public language = '';
  public translatable = false;
  public uploader: FileUploader;
  public currentValue: ImageResponse[] = [];
  public expandConfig:Map<number, boolean> = new Map<number, boolean>();
  public displayType: any[] = [
    {value: 'img', label: 'Full Image'},
    {value: 'cropped', label: 'Cropped Image'}
  ];
  public valueControl = new FormControl('');

  public positions: any[] = [
    'left top',
    'left center',
    'left bottom',
    'right top',
    'right center',
    'right bottom',
    'top left',
    'top right',
    'center top',
    'center center',
    'center bottom',
  ];

  constructor(private sanitizer: DomSanitizer, private http: HttpClient) {
    super();
    this.uploader = new FileUploader({
      url: environment.fileUploadApiURL,
      removeAfterUpload: true,
      headers: [
        {
          name: 'Access-Control-Allow-Origin',
          value: document.location.origin
        },
        {
          name: 'Access-Control-Allow-Credentials',
          value: 'true'
        }
      ],
    });


    this.uploader.response.pipe(map((result: string) => JSON.parse(result))).subscribe((response: ImageResponse) => {
      console.log(response);
      if (this.to.multiple === true) {
        this.currentValue.push(response);
      } else {
        this.currentValue = [response];
      }
      const newValue = this.formControl.value;
      newValue[this.language] =  this.currentValue;
      this.formControl.setValue(newValue);
    });
  }

  onFileSelected(item: any) {
    if (this.to.multiple === true) {

    } else {
      this.currentValue = [];
    }
  }

  ngOnInit(): void {
    this.translatable = true;
    this.language = this.to.defaultLocale;
    if (this.to?.language) {
      this.to.language.subscribe((language: string) => {
        if (language) {
          const validators = [];
          this.language = language;
          if (this.to.required) {
            validators.push(requiredTranslated(language));
          }
          this.formControl.setValidators(validators);
          this.formControl.updateValueAndValidity();
          if (!this.formControl.value) {
            const newValue: any = {};
            newValue[this.language] = [];
            this.formControl.setValue(newValue, {emitEvent: false});
          }
          if (Array.isArray(this.formControl.value)) {
            const newValue: any = {};
            newValue[this.language] = this.formControl.value;
            this.formControl.setValue(newValue, {emitEvent: false});
          }
          this.updateValue();
        }
      });
    }
  }

  updateValue(): void {
    let value = [];
    if (this.formControl.value
      && this.formControl.value.hasOwnProperty(this.language)
      && typeof this.formControl.value === 'object'
      && !Array.isArray(this.formControl.value)) {
      value = this.formControl.value[this.language] || [];
    };
    this.currentValue = value;
  }

  onChange(data: any) {

  }
  expandedConfig(i: number): void {
    if (!this.expandConfig.has(i)) {
        this.expandConfig.set(i, true);
    } else {
      this.expandConfig.set(i, !this.expandConfig.get(i));
    }
  }

  configExpanded(i: number): boolean | undefined {
    return this.expandConfig.get(i);
  }


  getImageUrl(item: any): SafeStyle | null {
    if (item?.file?.rawFile) {
      return this.sanitizer.bypassSecurityTrustStyle(`url(${URL.createObjectURL(item?.file?.rawFile)})`);
    }
    return null;
  }

  getValueUrl(item: ImageResponse): SafeStyle | null {
    if (item.name) {
      return this.sanitizer.bypassSecurityTrustStyle(`url('${environment.filePublicApiURL + 'small/' + item.name}')`);
    }
    return null;
  }

  removeValue(item: ImageResponse) {
    this.currentValue = this.currentValue.filter((image: ImageResponse) => image.id !== item.id);
    const currentValue = this.formControl.value;
    currentValue[this.language] = this.currentValue;
    this.formControl.setValue(currentValue);
  }
}
