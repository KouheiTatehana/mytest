@extends('layouts.parent')

@section('title', '商品情報詳細画面')

@section('content')
    <h1>商品情報詳細画面</h1>
    <div class="main-container">
        <div class="wrapper">
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $products->id }}</td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td>{{ $products->img_path }}</td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td>{{ $products->product_name }}</td>
                </tr>
                <tr>
                    <th>メーカー</th>
                    <td>{{ $products->company_name }}</td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td>{{ $products->price }}</td>
                </tr>
                <tr>
                    <th>在庫数</th>
                    <td>{{ $products->stock }}</td>
                </tr>
                <tr>
                    <th>コメント</th>
                    <td>{{ $products->comment }}</td>
                </tr>
            </table>
            <div class="btn-area">
                <a href="{{ route('edit', $products->id) }}"><button type="button" class="btn btn-first">編集</button></a>
                <a href="{{ route('list') }}"><button type="button" class="btn btn-redirect">戻る</button></a>
            </div>
        </div>
    </div>

@endsection