<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required', 'max:191',
            'description'  => 'required',
            'short_description'    => 'required', 'max:191',
            'medium' => 'required',
            'date_started' => 'required|digits:4|integer',
            'date_completed' => 'required|digits:4|integer|after_or_equal:date_started',
            'is_active' => 'required',
        ];
    }
}
