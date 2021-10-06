import { Component, OnInit } from '@angular/core';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';

@Component({
  selector: 'app-breadcrumbs',
  templateUrl: './breadcrumbs.component.html',
  styleUrls: ['./breadcrumbs.component.scss']
})
export class BreadcrumbsComponent implements OnInit {

  breadcrumb: BreadcrumbItem[] = [];

  constructor(private breadcrumbService: BreadcrumbService) {
  }

  ngOnInit(): void {
    this.breadcrumbService.breadcrumb$.subscribe((breadcrumb: BreadcrumbItem[]) => {
      this.breadcrumb = breadcrumb;
    });
  }

}
