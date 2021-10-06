import { Component, OnInit } from '@angular/core';
import {FieldWrapper} from '@ngx-formly/core';

@Component({
  selector: 'app-translatable',
  templateUrl: './translatable.component.html',
  styleUrls: ['./translatable.component.scss']
})
export class TranslatableComponent extends FieldWrapper implements OnInit {
  language = '';

  ngOnInit(): void {
    if (this.to?.translatable && this.to?.language) {
      this.to.language.subscribe((language: string) => {
        if (language) {
          this.language = language;
        }
      })
    }
  }

}
