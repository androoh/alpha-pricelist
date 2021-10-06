import { Injectable } from '@angular/core';
import {HttpEvent, HttpHandler, HttpHeaders, HttpRequest} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor() {
  }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    if (request.url === undefined || request.url === null) {
      return next.handle(request);
    }
    const headers = request.headers
      .set('X-Requested-With', 'XmlHttpRequest');
    return this.getNext(request.url, request, next, headers, false);
  }

  getNext(
    url: string,
    request: HttpRequest<any>,
    next: HttpHandler,
    headers: HttpHeaders,
    withCredentials: boolean = true): Observable<HttpEvent<any>> {
    headers = headers
      .set('Access-Control-Allow-Origin', document.location.origin)
      .set('Access-Control-Allow-Credentials', 'true');
    return next.handle(request.clone({
      headers,
      url,
      withCredentials
    }));
  }
}
