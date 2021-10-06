import { Component, OnInit } from '@angular/core';
import {BreadcrumbItem, BreadcrumbService} from '../../shared/services/breadcrumb.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {

  constructor(private breadcrumbService: BreadcrumbService) { }

  ngOnInit(): void {
    this.initBreadcrumb();
  }

  initBreadcrumb(): void {
    this.breadcrumbService.clear();
  }

}
