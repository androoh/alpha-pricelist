import {AfterViewInit, Component, OnInit, ViewChild, ViewContainerRef} from '@angular/core';
import {ResourcesService} from '../../shared/services/resources.service';
declare namespace Paged {
  class Previewer {
    preview(content: any, stylesheets: any, renderTo: any): any;
    removeStyles(html: any): void;
  }
}

@Component({
  selector: 'app-pagedjs',
  templateUrl: './pagedjs.component.html',
  styleUrls: ['./pagedjs.component.scss']
})
export class PagedjsComponent implements OnInit, AfterViewInit {
  @ViewChild('result', {read: ViewContainerRef}) htmlPages: ViewContainerRef;
  @ViewChild('iframe', {read: ViewContainerRef}) iframe: ViewContainerRef;

  constructor(private resourcesService: ResourcesService) {
  }

  ngOnInit(): void {

  }

  reload(): void {
    this.resourcesService.getHtml().toPromise().then((result: any) => {
      // this.displayContent(result);
    })
  }

  ngAfterViewInit() {
    // this.reload();
  }

  displayContent(result: string): void {
    const previewer = new Paged.Previewer();
    const html = (new DOMParser()).parseFromString(result, 'text/html');
    //@TODO move to RS
    const style = html.head.querySelector('style');
    if (style) {
      style.innerHTML = style.innerHTML + ' .hideSection{opacity:0.5; display:block}'
    }
    const hrefs = previewer.removeStyles(html);
    const content = html.querySelectorAll('body > *');
    html.querySelectorAll('a').forEach(element => {
      element.setAttribute('target', '_target');
    });
    const fragment = document.createDocumentFragment();
    let innerHtml = '';
    for (let i = 0; i < content.length; i++) {
      innerHtml += content[i].innerHTML;
      fragment.appendChild(content[i]);
    }
    const t0 = performance.now();
    this.htmlPages.element.nativeElement.innerHTML = '';
    try {
      previewer.preview(fragment, hrefs, this.htmlPages.element.nativeElement).then((flow: any) => {

      });
    } catch (e) {

    }
  }

  print(): void {

    const mywindow: Window | null = window.open('', 'PRINT', 'height=400,width=600');

    if (mywindow) {
      mywindow.document.write('<html><head><title>' + document.title  + '</title>');
      mywindow.document.write('</head><body >');
      mywindow.document.write(this.htmlPages.element.nativeElement.innerHTML);
      mywindow.document.write('</body></html>');

      mywindow.document.close(); // necessary for IE >= 10
      mywindow.focus(); // necessary for IE >= 10*/

      mywindow.print();
      mywindow.close();
    }
  }
}
