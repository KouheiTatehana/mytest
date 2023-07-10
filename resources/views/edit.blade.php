@extends('layouts.parent')

@section('title', '商品情報編集画面')

@section('content')
    <h1>商品情報編集画面</h1>
    <div class="main-container">
        <div class="wrapper">
            <form class="edit-form" action="{{ route('updateList', $products->id) }}" method="post" enctype="multipart/form-data">
            @csrf

                <table>
                    <tr>
                        <th>ID</th>
                        <td>{{ $products->id }}</td>
                    </tr>
                    <tr>
                        <th>商品名<span class="required-mark">*</span></th>
                        <td><input type="text" name="productName" class="input-area" value="{{ old('productName') }}"></td>
                        @if($errors->has('productName'))
                            <p class="error-message">{{ $errors->first('productName') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>メーカー名<span class="required-mark">*</span></th>
                        <td><select name="productMaker" class="select-area">
                                <option value=""></option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @if($errors->has('productMaker'))
                            <p class="error-message">{{ $errors->first('productMaker') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>価格<span class="required-mark">*</span></th>
                        <td><input type="text" name="productPrice" class="input-area" value="{{ old('productPrice') }}"></td>
                        @if($errors->has('productPrice'))
                            <p class="error-message">{{ $errors->first('productPrice') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>在庫数<span class="required-mark">*</span></th>
                        <td><input type="text" name="productStock" class="input-area" value="{{ old('productStock') }}"></td>
                        @if($errors->has('productStock'))
                            <p class="error-message">{{ $errors->first('productStock') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>コメント</th>
                        <td><textarea name="productComment" class="comment-area">{{ old('productComment') }}</textarea></td>
                        @if($errors->has('productComment'))
                            <p class="error-message">{{ $errors->first('productComment') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>商品画像</th>
                        <td><input type="file" name="productImg" class="upload-file"></td>
                    </tr>
                </table>
                <div class="btn-area">
                    <button type="submit" class="btn btn-first">更新</button>
                    <a href="{{ route('details', $products->id) }}"><button type="button" class="btn btn-redirect">戻る</button></a>
                </div>
            </form>
        </div>
    </div>
@endsection