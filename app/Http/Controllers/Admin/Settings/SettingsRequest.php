<?php
namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SettingsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // ($this->isMethod('POST') ? $this->store() : $this->update());
        $commonRules =  [
            'name' => 'required|string|max:250|min:3',
            'dob' => 'nullable|string|max:250|min:3',
            'email' => 'required|string|max:250|min:3',
            'phone' => 'required|digits:10',
            'description' => ['required' => function ($attribute, $value, $fail) {
                $sanitizedDescription = strip_tags($value);
                if (empty(trim($sanitizedDescription))) {
                    $fail('The :attribute field is required');
                } elseif (strlen($sanitizedDescription) < 25) {
                    $fail('The :attribute field must be 25 character long');
                }
            }],
            'address' => 'required|min:10',
            'socail_links' => 'nullable',
            'whatsapp_no' => 'nullable|digits:10',
        ];

        if ($this->isMethod('POST')) {
            return $this->store($commonRules);
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return $this->update($commonRules);
        }

        return [];
    }

    public function messages()
    {
        return [
            // 'name' => 'Please Enter Name',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => '400',
                    'errors' => $validator->errors(),
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }

    public function store($commonRules)
    {
        $storeRules = array_merge($commonRules, [
            'profile_pic' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);
        return $storeRules;
    }

    public function update($commonRules)
    {
        $updateRules = array_merge($commonRules, [
            'profile_pic' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);
        return $updateRules;
    }
}
