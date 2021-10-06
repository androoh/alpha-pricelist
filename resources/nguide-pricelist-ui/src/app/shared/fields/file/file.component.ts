import {Component, OnInit} from '@angular/core';
import {FieldType} from '@ngx-formly/core';
import {FileItem, FileUploader} from 'ng2-file-upload';
import {DomSanitizer, SafeStyle} from '@angular/platform-browser';
import {HttpClient} from '@angular/common/http';
import {map} from 'rxjs/operators';

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
  public uploader: FileUploader;
  public currentValue: ImageResponse[] = [];

  constructor(private sanitizer: DomSanitizer, private http: HttpClient) {
    super();
    this.uploader = new FileUploader({
      url: API_URL,
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
      if (this.to.multiple === true) {
        this.currentValue.push(response);
      } else {
        this.currentValue = [response];
      }

      this.formControl.setValue(this.currentValue);
    });
  }

  onFileSelected(item: any) {
    if (this.to.multiple === true) {

    } else {
      this.currentValue = [];
    }
  }

  ngOnInit(): void {
    this.currentValue = this.formControl.value || [];
  }

  onChange(data: any) {

  }

  getImageUrl(item: any): SafeStyle | null {
    if (item?.file?.rawFile) {
      return this.sanitizer.bypassSecurityTrustStyle(`url(${URL.createObjectURL(item?.file?.rawFile)})`);
    }
    return null;
  }

  getValueUrl(item: ImageResponse): SafeStyle | null {
    if (item.name) {
      return this.sanitizer.bypassSecurityTrustStyle(`url('${API_GET_FILE_URL + item.name}')`);
    }
    return null;
  }

  removeValue(item: ImageResponse) {
    this.currentValue = this.currentValue.filter((image: ImageResponse) => image.id !== item.id);
    this.formControl.setValue(this.currentValue);
  }
}
