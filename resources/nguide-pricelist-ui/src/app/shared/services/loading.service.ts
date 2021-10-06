import {Injectable} from '@angular/core';
import {Subject} from 'rxjs';

export class LoaderState {
  show?: boolean;
}

@Injectable({
  providedIn: 'root'
})
export class LoadingService {

  private loaderSubject: Subject<LoaderState> = new Subject<LoaderState>();
  private loadingQueue: any[] = [];

  constructor() {
  }

  get loaderState(): Subject<LoaderState> {
    return this.loaderSubject;
  }

  get isLoading(): boolean {
    return this.loadingQueue ? this.loadingQueue.length > 0 : false;
  }


  public startLoading(request: any): void {
    if (this.loadingQueue.indexOf(request) === -1) {
      this.loadingQueue.push(request);
      this.loaderSubject.next({show: true} as LoaderState);
    }
  }

  public endLoading(request: any): void {
    const index = this.loadingQueue.indexOf(request, 0);
    if (index > -1) {
      this.loadingQueue.splice(index, 1);
    }
    this.loaderSubject.next({show: false} as LoaderState);
  }

  public clearLoading(): void {
    this.loadingQueue = [];
    this.loaderSubject.next({show: false} as LoaderState);
  }
}
