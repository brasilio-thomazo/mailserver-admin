<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDomainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:domains,id',
            'name' => 'required|string|unique:domains,name,' . $this->id,
            'home' => 'required|string',
            'uid' => 'required|numeric|min:100|max:9999',
            'gid' => 'required|numeric|min:100|max:9999'
        ];
    }
}
