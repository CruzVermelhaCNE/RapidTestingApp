<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\GetLocationSchedulesRequest;
use App\Models\Appointment;
use App\Models\Location;
use App\Models\LocationSchedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function schedules(GetLocationSchedulesRequest $request)
    {
        $validated = $request->validated();
        $locations = Location::where('code', '=', $validated["code"])->get();
        if ($locations->count() !== 1) {
            return [];
        }
        $location = $locations->first();
        $schedules = [];
        foreach ($location->schedules as $schedule) {
            $schedules[] = ["id" => $schedule["id"], "slots"  => $schedule["slots"], "date" => $schedule["date"], "time" => $schedule["time"]];
        }
        return $schedules;
    }

    public function create(CreateAppointmentRequest $request)
    {
        $validated = $request->validated();
        $locations = Location::where('code', '=', $validated["code"])->get();
        if ($locations->count() !== 1) {
            return response(null, 409);
        }
        $location = $locations->first();
        $location_schedule = LocationSchedule::findOrFail($validated["id"]);
        if ($location->id != $location_schedule->location->id) {
            return response(null, 409);
        }
        if ($location_schedule->slots <= 0) {
            return response(null, 409);
        }
        Appointment::create($validated["id"], $validated["name"], $validated["sns"]);
        return response(null, 200);
    }
}
