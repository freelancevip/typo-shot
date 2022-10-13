<?php

namespace App\Http\Requests;

use App\Models\Screenshot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScreenshotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('screenshot_create');
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
