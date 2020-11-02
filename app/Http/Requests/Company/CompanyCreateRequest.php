<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        //TODO: finish validation rules
        return [
            'company.name' => 'required|string|min:3',
            'company.tax_number' => 'required|string|min:3',
        ];
    }
}
