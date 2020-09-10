<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public static function create($location_schedule_id, $name, $sns)
    {
        $appointment = new Appointment();
        $appointment->location_schedule_id = $location_schedule_id;
        $appointment->name = $name;
        $appointment->sns = $sns;
        $appointment->save();
        return $appointment;
    }
}
