<?php

namespace App\Http\Controllers\Api\V1;

use App\Exports\ResidentPaymentReport;
use App\Http\Requests\CheckStayRequest;
use App\Http\Requests\GenerateResidentPaymentReportStayRequest;
use App\Http\Resources\StayResource;
use App\Models\Stay;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Services\StayService;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class StayController extends BaseAPIController
{
    /**
     * .
     *
     * @param CheckStayRequest $request
     * @return JsonResponse
     */
    public function checkIn(CheckStayRequest $request): JsonResponse
    {
        $licensePlateNumber = $request->input('license_plate_number');
        $vehicle = Vehicle::where('license_plate_number', $licensePlateNumber)->first();

        $stay = Stay::create([
            'vehicle_id' => $vehicle->id,
            'check_in' => Carbon::now(),
            'measure_unit' => $vehicle->vehicleType->vehicleTypeCost->measure_unit
        ]);

        $stay->load('vehicle');

        return $this->successWithData('Successfully checked in', new StayResource($stay));
    }

    /**
     * .
     *
     * @param CheckStayRequest $request
     * @param StayService $stayService
     * @return JsonResponse
     */
    public function checkOut(CheckStayRequest $request, StayService $stayService): JsonResponse
    {
        $licensePlateNumber = $request->input('license_plate_number');
        $vehicle = Vehicle::where('license_plate_number', $licensePlateNumber)->first();
        $stay = Stay::where('vehicle_id', $vehicle->id)->where('check_in', '!=', null)
            ->where('check_out', null)->first();

        if (is_null($stay)) {
            return $this->errorNotFound(
                'Stay not found',
                "Stay's data does not match our records"
            );
        }

        $accumulatedTime = $stayService->getAccumulatedTimePerStay($stay);

        $stay->update([
            'check_out' => Carbon::now(),
            'accumulated_time' => $accumulatedTime,
            'total_to_pay' => $stay->vehicle->vehicleType->vehicleTypeCost->cost_per_measure_unit * $accumulatedTime
        ]);

        $stay->load('vehicle');
        return $this->successWithData('Successfully checked out', new StayResource($stay));
    }

    /**
     * @param StayService $stayService
     * @return JsonResponse
     */
    public function monthStarts(StayService $stayService): JsonResponse
    {
        $recordsRestarted = $stayService->resetAccumulatedTimeByVehicleType();

        if (is_null($recordsRestarted)) {
            return $this->errorInternalError(
                'Something went wrong or it is possible that the data has already been reset'
            );
        }

        return $this->success("Successfully reset cumulative time by vehicle type of ${recordsRestarted} records");
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function generateResidentPaymentReport(GenerateResidentPaymentReportStayRequest $request)
    {
        Stay::select(['id', 'check_in', 'check_out', 'total_to_pay'])
            ->whereHas('vehicle', function ($query) {
                $query->whereHas('vehicleType', function ($query) {
                    $query->whereName('resident');
                });
            })
            ->get()
            ->each(function ($stay) {
                $stay->check_in = Carbon::parse($stay->check_in)->format('d/m/Y H:i:s');
                $stay->check_out = Carbon::parse($stay->check_out)->format('d/m/Y H:i:s');
            });
        return (new ResidentPaymentReport)->download($request->input('file_name') . 'xlsx');
    }

}
