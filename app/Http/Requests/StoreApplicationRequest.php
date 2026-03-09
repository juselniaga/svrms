<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Developer Validation (Create new logic or attach existing in real spec, assuming create here)
            'developer.name' => 'required|string|max:255',
            'developer.address1' => 'required|string|max:255',
            'developer.address2' => 'nullable|string|max:255',
            'developer.poskod' => 'required|string|max:10',
            'developer.city' => 'required|string|max:100',
            'developer.state' => 'required|string|max:100',
            'developer.email' => 'required|email|max:255',
            'developer.fax' => 'nullable|string|max:20',
            'developer.tel' => 'required|string|max:20',

            // Application Validation
            'application.reference_no' => 'nullable|string|unique:applications,reference_no',
            'application.tajuk' => 'required|string',
            'application.lokasi' => 'required|string',
            'application.no_fail' => 'required|string|max:255',
        ];
    }
}
