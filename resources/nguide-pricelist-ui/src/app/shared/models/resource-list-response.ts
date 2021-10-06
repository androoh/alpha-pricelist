export class ResourceListMetaResponse {
  current_page: number;
  from: number;
  last_page: number;
  path: string;
  per_page: number;
  to: number;
  total: number;
}

export class ResourceListResponse {
  meta: ResourceListMetaResponse;
  data: any[];
}
