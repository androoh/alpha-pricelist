import {ChangeDetectorRef, Component, OnDestroy, OnInit} from '@angular/core';
import {Subscription} from 'rxjs';
import {LoaderState, LoadingService} from '../../shared/services/loading.service';

@Component({
  selector: 'app-loading',
  templateUrl: './loading.component.html',
  styleUrls: ['./loading.component.scss']
})
export class LoadingComponent implements OnInit, OnDestroy {

  private loaderSubscription?: Subscription;
  public isLoading = false;

  constructor(public loadingService: LoadingService, private cdRef: ChangeDetectorRef) {
  }

  ngOnInit(): void {
    this.loaderSubscription = this.loadingService.loaderState
      .subscribe((state: LoaderState) => {
        this.isLoading = this.loadingService.isLoading;
        this.cdRef.detectChanges();
      });
  }

  ngOnDestroy(): void {
    if (this.loaderSubscription) {
      this.loaderSubscription.unsubscribe();
    }
  }

}
