<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'application_id' => 'required|exists:applications,application_id',
            'review_content' => 'required|string',
            'recommendation' => 'required|in:SOKONG,TIDAK_SOKONG,BERSYARAT',
            'is_submitted' => 'boolean', // To differentiate draft vs submit
        ];
    }
}
