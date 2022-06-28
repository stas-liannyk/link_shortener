<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $regex = '/^(https*?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'original_link' => 'required|string|min:12|max:2048|unique:links|regex:' . $regex,
            'visit_limit' => 'required|numeric|min:0|max:2147483647',
            'lifetime' => 'required|numeric|min:1|max:24',
        ];
    }
}
