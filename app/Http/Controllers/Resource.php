<?php

namespace App\Http\Controllers;

use App\Formly\FormlyFieldConfig;
use App\Http\Requests\ResourceRequest;
use App\Resources\Category;
use App\Resources\InfoIcon;
use App\Resources\PriceList;
use App\Resources\Product;
use function GuzzleHttp\json_decode;

class Resource extends Controller
{
    const PAGE_LIMIT = 10;
    const PAGE_LIMIT_MAX = 1000;

    public function resources()
    {
        $resources = [
            (new Product())::getInfo(),
            (new PriceList())::getInfo(),
            (new Category())::getInfo(),
            (new InfoIcon())::getInfo()
        ];
        return response($resources);
    }

    public function getResourceByName(ResourceRequest $request, $resourceName)
    {
        $resource = $request->getResource($resourceName);
        return response($resource::getInfo());
    }

    public function getFilters(ResourceRequest $request, $resourceName)
    {
        $resource = $request->getResource($resourceName);
        $filters = $resource->getFilters($request);
        return response([
            'defaultLocale' => config('app.locale'),
            'schema' => $filters
        ]);
    }

    public function resourceList(ResourceRequest $request, $resourceName)
    {
        $sortBy = $request->query('sortBy', '_id');
        $sortDir = $request->query('sortDir', 'desc');
        $filters = $request->query('filters', null);
        $resourceIds = $request->query('resourceIds', null);
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $model = new $model();
        if ($resourceIds) {
            $resourceIds = explode(',', $resourceIds);
            $model = $model->whereIn('_id', $resourceIds);
        }
        $columns = $resource->getGridColumns($request);
        $projections = $this->getProjections($columns);
        if ($filters) {
            $filters = json_decode($filters, true);
            if ($filters) {
                $model = $model->whereRaw($filters);
            }
        }
        if (!$resourceIds) {
            $result = $model->orderBy($sortBy, $sortDir)->paginate(self::PAGE_LIMIT, $projections)->toArray();
        } else {
            $result = $model->paginate(self::PAGE_LIMIT_MAX, $projections);
            $result->setCollection($result->getCollection()->map(function(&$item) use ($resourceIds) {
                    $order = array_search($item->getKey(), $resourceIds) ?? 0;
                    $item['order'] = $order;
                    return $item;
                })->sortBy(['order', 'desc']));
            $result = $result->toArray();
        }
        $result['filters'] = $filters;
        $result['columns'] = $columns;
        $result['defaultLocale'] = config('app.locale');
        $result['config'] = $resource->config($request);
        $result['sort'] = [
            'sortBy' => $sortBy,
            'sortDir' => $sortDir
        ];
        return response($result);
    }

    protected function getProjections($columns)
    {
        return collect($columns)->map(function ($column) {
            return $column->path;
        })->toArray();
    }

    public function create(ResourceRequest $request, $resourceName)
    {
        return response([
            'schema' => $request->getResource($resourceName)->fieldsToArray($request),
            'data' => [],
            'config' => $request->getResource($resourceName)->config($request),
            'defaultLocale' => config('app.locale'),
            'locales' => config('app.locales')
        ]);
    }

    public function edit(ResourceRequest $request, $resourceName, $id)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $resourceData = $model::find($id);

        return response([
            'schema' => $request->getResource($resourceName)->fieldsToArray($request),
            'data' => $resourceData,
            'config' => $request->getResource($resourceName)->config($request),
            'defaultLocale' => config('app.locale'),
            'locales' => config('app.locales')
        ]);
    }

    public function store(ResourceRequest $request, $resourceName)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $model = (new $model())->fill($request->input());
        $resource->beforeSave($request, $model);
        $model->save();
        $resource->afterSave($request, $model);

        return response([
            'schema' => $request->getResource($resourceName)->fieldsToArray($request),
            'data' => $model
        ]);
    }

    public function update(ResourceRequest $request, $resourceName, $id)
    {
        $filedConfig = new FormlyFieldConfig();
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $clearedArray = $filedConfig->toArray($request->input());
        $model = $model::find($id);
        $model = $model::find($id)->fill($clearedArray);
        $resource->beforeSave($request, $model);
        $model->save();
        $resource->afterSave($request, $model);

        return response([
            'schema' => $request->getResource($resourceName)->fieldsToArray($request),
            'data' => $model
        ]);
    }

    public function remove(ResourceRequest $request, $resourceName, $id)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $model::find($id)->forceDelete();
        return response(['ok']);
    }

    public function clone(ResourceRequest $request, $resourceName, $id)
    {
        $resource = $request->getResource($resourceName);
        $model = $resource::model();
        $replicatedModel = $model::find($id)->replicate();
        $replicatedModel->save();
        return response(['ok']);
    }
}
