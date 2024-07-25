<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreSecretRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'secret' => 'required|string|max:1000',
            'expire_after_views' => 'required|numeric|min:1',
            'expire_after_minutes' => 'required|numeric|min:0',
        ];
    }

    public function getRequestParams(): array
    {
        $expiryMinutes = (int)$this->expire_after_minutes;

        return [
            'secret_text' => $this->secret,
            'remaining_views' => (int)$this->expire_after_views,
            'expires_at' => $expiryMinutes == 0 ?
                null :
                Carbon::now()->addMinutes($expiryMinutes),
        ];
    }
}
