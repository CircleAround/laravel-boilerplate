<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamModifyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 今回はroutesのMiddlewareで認証をしているので真で良い
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // 必要なバリデーションルールを返す
        return [
            'name' => 'required|max:20',
        ];
    }
}
