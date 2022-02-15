import { Injectable } from '@angular/core';
import {HttpErrorResponse, HttpEvent, HttpHandler, HttpRequest, HttpResponse} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, map} from 'rxjs/operators';
import {LoadingService} from '../services/loading.service';

export const RUN_IN_BACKGROUND = '@runInBackground';
@Injectable({
  providedIn: 'root'
})
export class LoadingInterceptorService {

  constructor(private loadingService: LoadingService) {
  }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    if (request.url === undefined || request.url === null) {
      return next.handle(request);
    }
    if (this.isRunInBackground(request.url)) {
      return next.handle(request.clone({
        url: this.cleanUrl(request.url)
      }));
    }
    this.loadingService.startLoading(request.urlWithParams);
    return next.handle(request)
      .pipe(
        map((event: HttpEvent<any>) => {
          if (event instanceof HttpResponse) {
            this.loadingService.endLoading(request.urlWithParams);
          }
          return event;
        }),
        catchError((error: HttpErrorResponse) => {
          this.loadingService.endLoading(request.urlWithParams);
          return throwError(error);
        }));
  }

  isRunInBackground(urlPath: string): boolean {
    return (urlPath.indexOf(RUN_IN_BACKGROUND) !== -1);
  }

  cleanUrl(url: string): string {
    return url.replace('/' + RUN_IN_BACKGROUND, '');
  }
}
