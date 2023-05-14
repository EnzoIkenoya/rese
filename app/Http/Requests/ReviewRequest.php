<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'detail/review') {
            return true;
        } else {
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
            'star' => 'required|integer',
            'review' => 'required|string'
        ];
    }

    public function message()
    {
        return [
            'star.required' => '評価を入力してください',
            'review.required' => 'レビューを入力してください',

        ];
    }
}

