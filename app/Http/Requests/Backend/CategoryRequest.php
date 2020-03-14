<?php

namespace App\Http\Requests\Backend;

use App\Model\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'title' => [
                'required',
                'unique:categories,title'
            ],
            'meta_title' => [
                'required',
                'max:70'
            ],
            'logo' => [
                'required'
            ]
        ];
        if ($request->method() == 'PUT') {
            $rules = [
                'title' => [
                    'required',
                    Rule::unique((new Category())->getTable())->ignore($this->route()->category->id ?? null)
                ],
                'meta_title' => [
                    'required',
                    'max:70',
                    Rule::unique((new Category())->getTable())->ignore($this->route()->category->id ?? null)
                ],
                'logo' => [
                    'required'
                ]
            ];
        }
        return $rules;
    }
}
