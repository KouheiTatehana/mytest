<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
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
            'product_name' => 'required | max:255',
            'company_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'comment' => 'present | max:10000',
            'img_path' => 'nullable',
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
            'product_name' => '商品名',
            'company_name' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'img_path' => '商品画像',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.max' => ':attributeは:max字以内で入力してください。',
            'company_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'stock.required' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}
