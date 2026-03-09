<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteVisitRequest extends FormRequest
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
            'visit_date' => 'required|date',

            // Findings
            'finding_north' => 'nullable|string',
            'finding_south' => 'nullable|string',
            'finding_east' => 'nullable|string',
            'finding_west' => 'nullable|string',

            // Photos - Optional replacements
            'photos_north.*' => 'nullable|image|max:2048',
            'photos_south.*' => 'nullable|image|max:2048',
            'photos_east.*' => 'nullable|image|max:2048',
            'photos_west.*' => 'nullable|image|max:2048',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,png|max:5120',

            // Site Conditions
            'activity' => 'nullable|string|max:255',
            'facility' => 'nullable|string|max:255',
            'entrance_way' => 'nullable|string|max:255',
            'parit' => 'nullable|string|max:255',
            'tree' => 'nullable|integer|min:0',
            'land_use_zone' => 'nullable|string|max:255',
            'density' => 'nullable|string|max:255',
            'recommend_road' => 'nullable|boolean',
            'parking' => 'nullable|string|max:255',
            'anjakan' => 'nullable|string|max:255',
            'social_facility' => 'nullable|string|max:255',
            'location_data' => 'nullable|string',
        ];
    }
}
