<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSchedule extends Model
{
    use HasFactory;

    protected $dates = [
        'datetime',
    ];

    protected $appends = ["slots","date","time"];

    public static function create($location_id, $datetime, $max_slots)
    {
        $schedule = new LocationSchedule();
        $schedule->location_id = $location_id;
        $schedule->datetime = $datetime;
        $schedule->max_slots = $max_slots;
        $schedule->save();
        return $schedule;
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getSlotsAttribute()
    {
        return ($this->max_slots - $this->appointments->count());
    }

    public function getDateAttribute()
    {
        return $this->datetime->isoFormat('DD-MM-YYYY');
    }

    public function getTimeAttribute()
    {
        return $this->datetime->isoFormat('HH:mm');
    }
}
