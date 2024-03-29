<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'keyword' => 'required | max:255',
            'makerKeyword' => 'required',
        ];
    }

    /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'keyword' => 'キーワード',
            'makerKeyword' => 'メーカー名',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'keyword.required' => ':attributeは必須項目です。',
            'keyword.max' => ':attributeは:max字以内で入力してください。',
            'makerKeyword.required' => ':attributeは必須項目です。',
        ];
}
}
