<?php
namespace App\Http\Controllers\Admin\Policy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PolicyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        // ($this->isMethod('POST') ? $this->store() : $this->update());
        $commonRules =  [
            'description' => ['required' => function ($attribute, $value, $fail) {
                $sanitizedDescription = strip_tags($value);
                if (empty(trim($sanitizedDescription))) {
                    $fail('The :attribute field is required');
                } elseif (strlen($sanitizedDescription) < 25) {
                    $fail('The :attribute field must be 25 character long');
                }
            }],
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
            // // 'demo_img' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            // 'image' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);
        return $storeRules;
    }

    public function update($commonRules)
    {
        $updateRules = array_merge($commonRules, [
            // 'image' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);
        return $updateRules;
    }
}
