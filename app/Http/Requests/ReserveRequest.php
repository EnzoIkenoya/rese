<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'detail/reserve' or $this->path() == 'detail/reserve/update') {
            return true;
        }else{
            return false;
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'reserve_date' => 'required|date_format:Y-m-d|after:today|before:2months',
            'reserve_time' => 'required|date_format:H:i',
            'number' => 'required|integer'
        ];
    }
}
