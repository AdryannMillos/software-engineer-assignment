<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreDispostionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'candidate_id' => 'required|integer|exists:candidates,id',
            'disposition' => 'required|string|in:undecided,hired,rejected',
            'hire_type' => 'nullable|string|in:internal,external',
            'fee' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:255|min:2',
            'rejection_reason' => 'nullable|string|max:255|min:2',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message'=>$validator->errors()->first()], 422));
    }
}

