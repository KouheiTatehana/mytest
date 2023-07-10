<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'productName' => 'required | max:255',
            'productMaker' => 'required',
            'productPrice' => 'required',
            'productStock' => 'required',
            'productComment' => 'present | max:10000',
            'productImg' => 'nullable',
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
            'productName' => '商品名',
            'productMaker' => 'メーカー名',
            'productPrice' => '価格',
            'productStock' => '在庫数',
            'productComment' => 'コメント',
            'productImg' => '商品画像',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'productName.required' => ':attributeは必須項目です。',
            'productName.max' => ':attributeは:max字以内で入力してください。',
            'productMaker.required' => ':attributeは必須項目です。',
            'productPrice.required' => ':attributeは必須項目です。',
            'productStock.required' => ':attributeは必須項目です。',
            'productComment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}
