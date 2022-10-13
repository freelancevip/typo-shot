<?php

namespace App\Http\Requests;

use App\Models\Screenshot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateScreenshotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('screenshot_edit');
    }

    public function rules()
    {
        return [
            'response' => [
                'string',
                'nullable',
            ],
        ];
    }
}
