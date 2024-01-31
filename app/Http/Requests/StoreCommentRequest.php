<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  auth('web')->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => auth("web")->id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parent_id' => 'nullable | numeric',
            'user_id' => 'required | exists:App\Models\User,id',
            'content' => 'required',
        ];
    }
}
