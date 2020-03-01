<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'firstName' => [
                'required', 'min:3'
            ],
            'lastName' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'mobile' => [
                'required', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null),'regex:/(0)[0-9]{9}/'
            ],
            'password' => [
                $this->route()->user ? 'nullable' : 'required', 'min:8'
            ]
        ];
        if ($request->method() == 'PUT'){
            $rules =[
                'firstName' => [
                    'required', 'min:3'
                ],
                'lastName' => [
                    'required', 'min:3'
                ],
                'email' => [
                    'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
                ],
                'mobile' => [
                    'required', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
                ],
                'password' => [
                    $this->route()->user ? 'nullable' : 'required', 'min:8'
                ]
            ];
        }
        return $rules;
    }
}
