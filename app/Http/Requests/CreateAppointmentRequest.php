<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "code" => ["required","uuid","exists:locations,code"],
            "id" => ["required","exists:location_schedules"],
            "name" => ["required","string"],
            "sns" => ["required","string"],
        ];
    }
}
