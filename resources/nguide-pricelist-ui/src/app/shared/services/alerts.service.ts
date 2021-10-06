import { Injectable } from '@angular/core';
import {BehaviorSubject} from 'rxjs';

export enum AlertType {
  danger = 'danger',
  success = 'success',
  warning = 'warning',
  info = 'info'
}

export class Alert {
  id: number;
  type: AlertType;
  dismissible: boolean;
  msg: string;
  closeDelay: number;
  constructor(props?: any) {
    this.id = props?.id || 0;
    this.type = props?.type || AlertType.info;
    this.dismissible = props?.dismissible || false;
    this.msg = props?.msg || '';
    this.closeDelay = props?.closeDelay || 1000;
  }
}
@Injectable({
  providedIn: 'root'
})
export class AlertsService {

  idCount = 1;
  modalRefs = new Map();
  alerts: Alert[] = [];

  show(type: AlertType, msg: string, closeDelay: number = 1500) {
    this.alerts.push({
      id: this.idCount,
      type: type,
      msg,
      dismissible: true,
      closeDelay
    });
    this.idCount++;
  }

  onClosed(dismissedAlert: Alert): void {
    this.alerts = this.alerts.filter((alert: Alert) => alert.id !== dismissedAlert.id);
  }

}
