import {Injectable} from '@angular/core';
import {Column, ResourceListListResponse} from './resources.service';

@Injectable({
  providedIn: 'root'
})
export class TableService {

  mapRowsAndColumns(result: ResourceListListResponse): { rows: any[]; columns: any[] } {
    const rows = [];
    const mappedColumns = this.mapColumns(result.columns);
    const columns = this.getColumns(mappedColumns);
    for (let itemKey in result.data) {
      const item = result.data[itemKey];
      const rowItem: any = {};
      rowItem['id'] = item._id;
      for (let column of columns) {
        rowItem[column.prop] = this.getDataByPath(item, column.path) || '-';
      }
      rows.push(rowItem);
    }
    return {rows, columns};
  }

  mapColumns(columns: Column[]): any {
    const mappedColumns: any = {};
    if (columns) {
      columns.forEach((column: Column) => {
        if (column.type === 'translatable-input' || column.type === 'input' || column.type === 'select') {
          mappedColumns[column.key] = {
            prop: column.key,
            path: column.path,
            name: column?.templateOptions?.label || this.capitalize(column.key),
            sortable: column?.templateOptions?.sortable || false,
            draggable: column?.templateOptions?.draggable || false,
            resizable: column?.templateOptions?.resizable || false,
            flexGrow: column?.templateOptions?.flexGrow || 1,
            translatable: column?.templateOptions?.translatable || false
          };
        }
      });
    }
    return mappedColumns;
  }

  private getDataByPath(data: any, path: string): any {
    path = path.replace(/\[(\w+)\]/g, '.$1'); // convert indexes to properties
    path = path.replace(/^\./, '');           // strip a leading dot
    let a = path.split('.');
    for (let i = 0, n = a.length; i < n; ++i) {
      let k = a[i];
      if (k in data) {
        data = data[k];
      } else {
        return;
      }
    }
    return data;
  }

  private capitalize(word: string) {
    if (!word) return word;
    return word[0].toUpperCase() + word.substr(1).toLowerCase();
  }

  public getColumns(mappedColumns: any[]): any[] {
    let result: any[] = [];
    for (let columnKey in mappedColumns) {
      if (mappedColumns.hasOwnProperty(columnKey)) {
        result.push(mappedColumns[columnKey]);
      }
    }
    return result;
  }
}
