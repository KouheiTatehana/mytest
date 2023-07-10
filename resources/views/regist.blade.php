@extends('layouts.parent')

@section('title', '商品新規登録画面')

@section('content')
    <h1>商品新規登録画面</h1>
    <div class="main-container">
        <div class="wrapper">
            <form class="regist-form" action="{{ route('newRegist') }}" method="post" enctype="multipart/form-data">    
            @csrf

                <table>
                    <tr>
                        <th>商品名<span class="required-mark">*</span></th>
                        <td><input type="text" name="product_name" class="input-area" value="{{ old('product_name') }}"></td>
                        @if($errors->has('product_name'))
                            <p class="error-message">{{ $errors->first('product_name') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>メーカー名<span class="required-mark">*</span></th>
                        <td>
                            <select name="company_name" class="select-area">
                                <option value=""></option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        @if($errors->has('company_name'))
                            <p class="error-message">{{ $errors->first('company_name') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>価格<span class="required-mark">*</span></th>
                        <td><input type="text" name="price" class="input-area" value="{{ old('price') }}"></td>
                        @if($errors->has('price'))
                            <p class="error-message">{{ $errors->first('price') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>在庫数<span class="required-mark">*</span></th>
                        <td><input type="text" name="stock" class="input-area" value="{{ old('stock') }}"></td>
                        @if($errors->has('stock'))
                            <p class="error-message">{{ $errors->first('stock') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>コメント</th>
                        <td><textarea name="comment" class="comment-area">{{ old('comment') }}</textarea></td>
                        @if($errors->has('comment'))
                            <p class="error-message">{{ $errors->first('comment') }}</p>
                        @endif
                    </tr>
                    <tr>
                        <th>商品画像</th>
                        <td><input type="file" name="img_path" class="upload-file"></td>
                    </tr>
                </table>
                <div class="btn-area">
                    <button type="submit" class="btn btn-first">新規登録</button>
                    <a href="{{ route('list') }}"><button type="button" class="btn btn-redirect">戻る</button></a>
                </div>
            </form>
        </div>
    </div>
@endsection