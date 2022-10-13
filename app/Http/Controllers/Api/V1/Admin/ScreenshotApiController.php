<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScreenshotRequest;
use App\Http\Requests\UpdateScreenshotRequest;
use App\Http\Resources\Admin\ScreenshotResource;
use App\Models\Screenshot;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ScreenshotApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('screenshot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScreenshotResource(Screenshot::advancedFilter());
    }

    public function store(StoreScreenshotRequest $request)
    {
        $screenshot = Screenshot::create($request->validated());

        return (new ScreenshotResource($screenshot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('screenshot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [],
        ]);
    }

    public function show(Screenshot $screenshot)
    {
        abort_if(Gate::denies('screenshot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ScreenshotResource($screenshot);
    }

    public function update(UpdateScreenshotRequest $request, Screenshot $screenshot)
    {
        $screenshot->update($request->validated());

        return (new ScreenshotResource($screenshot))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Screenshot $screenshot)
    {
        abort_if(Gate::denies('screenshot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new ScreenshotResource($screenshot),
            'meta' => [],
        ]);
    }

    public function destroy(Screenshot $screenshot)
    {
        abort_if(Gate::denies('screenshot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $screenshot->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
