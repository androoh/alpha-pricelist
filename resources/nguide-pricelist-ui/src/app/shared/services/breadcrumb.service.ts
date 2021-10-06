import {Injectable} from '@angular/core';
import {Subject} from 'rxjs';

export interface BreadcrumbItem {
  icon?: any;
  label: string;
  path: any[];
}

@Injectable({
  providedIn: 'root'
})
export class BreadcrumbService {
  breadcrumb$: Subject<BreadcrumbItem[]> = new Subject<BreadcrumbItem[]>();
  private breadcrumb: BreadcrumbItem[] = [];

  setBreadcrumb(breadcrumb: BreadcrumbItem[]): void {
    this.breadcrumb = breadcrumb;
  }

  update(): void {
    this.breadcrumb$.next(this.breadcrumb);
  }

  clear(): void {
    this.breadcrumb = [];
    this.update();
  }
}
