<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends BaseAPIController
{
    /**
     * Display a listing of the resource.
     *
     * @param StoreVehicleRequest $request
     * @return JsonResponse
     */
    public function store(StoreVehicleRequest $request): JsonResponse
    {
        $vehicle = Vehicle::create($request->all());

        if (is_null($vehicle)) {
            return $this->errorInternalError();
        }

        $vehicle->load('vehicleType');
        return $this->successCreated('Successfully created vehicle', new VehicleResource($vehicle));
    }
}
