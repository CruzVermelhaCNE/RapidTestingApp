<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    public static function create($name)
    {
        $code = (string) Str::uuid();
        $location = new Location();
        $location->name = $name;
        $location->code = $code;
        $location->save();
        return $location;
    }

    public function schedules()
    {
        return $this->hasMany(LocationSchedule::class);
    }
}
