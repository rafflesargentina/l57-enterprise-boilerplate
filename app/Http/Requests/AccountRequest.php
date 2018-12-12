<?php

namespace Raffles\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();

        return [
            'email' => [
                'required',
                Rule::unique($user->getTable())->ignore($user->id),
            ],
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'nullable|confirmed|min:6',
        ];
    }
}
