import {Component, OnInit} from '@angular/core';
import {ResourcesResponse, ResourcesService} from '../../shared/services/resources.service';
import {Subscription} from 'rxjs';

@Component({
  selector: 'app-left-sidebar',
  templateUrl: './left-sidebar.component.html',
  styleUrls: ['./left-sidebar.component.scss']
})
export class LeftSidebarComponent implements OnInit {

  public resources: ResourcesResponse[] = [];
  private subscriptions: Subscription[] = [];

  constructor(private resourcesService: ResourcesService) {
  }

  ngOnInit(): void {
    this.subscriptions.push(
      this.resourcesService.getResources().subscribe((result: ResourcesResponse[]) => this.resources = result)
    );
  }

}
