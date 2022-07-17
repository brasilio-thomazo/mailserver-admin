<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreDomainDkimRequest extends FormRequest
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
            'domain_id' => 'required|exists:domains,id',
            'selector' => 'required|string|max:14|unique:domain_dkims,selector',
            'private_key' => 'required_with:public_key',
            'public_key' => 'required_with:private_key'
        ];
    }

    public function keypair()
    {
        if (!$this->private_key || !$this->public_key) {
            $pk = openssl_pkey_new([
                'digest_alg' => env('DKIM_ALGORITHM', 'sha256'),
                'private_key_bits' => env('DKIM_KEY_BITS', 2048),
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ]);

            openssl_pkey_export($pk, $private_key);

            $details = openssl_pkey_get_details($pk);
            $public_key = $details['key'];
            return [$private_key, $public_key];
        }
        $this->verify_keypair();
        return [$this->private_key, $this->public_key];
    }

    private function verify_keypair()
    {
        if (!($public_key = openssl_pkey_get_public($this->public_key))) {
            throw ValidationException::withMessages(['public_key' => ['Public key invalid']]);
        }

        if (!($private_key = openssl_pkey_get_private($this->private_key))) {
            throw ValidationException::withMessages(['private_key' => ['Private key invalid']]);
        }

        $data = "String test data";
        openssl_sign($data, $signature, $private_key);
        $verify = openssl_verify($data, $signature, $public_key, $this->algorithm);
        if ($verify == -1) {
            $error = openssl_error_string();
            throw ValidationException::withMessages(['public_key' => [$error], 'private_key' => [$error]]);
        } else if (!$verify) {
            throw ValidationException::withMessages(['public_key' => ['Key pair incorrect'], 'private_key' => ['Key pair incorrect']]);
        }
    }
}
