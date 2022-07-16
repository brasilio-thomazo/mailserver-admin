<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDomainUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'domain_id' => 'required|numeric|exists:domains,id',
            'user' => 'required|regex:/^[\w\d\._-]+$/|max:25|unique:domain_users,user,NULL,id,domain_id,' . $this->domain_id,
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
