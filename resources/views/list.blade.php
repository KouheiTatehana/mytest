<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/css/list.css') }}" rel="stylesheet">
    <title>商品一覧画面</title>
</head>
<body>
    <div class="container">
        <h1>商品一覧画面</h1>
        <div class="form-group">
            <form class="form-desc" action="{{ route('listSearch') }}" method="post">
            @csrf
                <input type="text" class="form-search" name="keyword" placeholder="検索キーワード">
                <select class="form-select" name="makerKeyword">
                    <option value="選択されていません">メーカー名</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-search" value="検索">
            </form>
        </div>

        <div class="table-container">
            <table class="table" border="1" cellspacing="0">
                <thead>
                    <tr class="row-head">
                        <th class="right-border">ID</th>
                        <th class="left-border right-border">商品画像</th>
                        <th class="left-border right-border">商品名</th>
                        <th class="left-border right-border">価格</th>
                        <th class="left-border right-border">在庫数</th>
                        <th class="left-border right-border">メーカー名</th>
                        <th class="left-border" colspan="2"><a href="{{ route('new') }}"><button type="button" class="btn btn-register">新規登録</button></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="row-body">
                        <td class="right-border">{{ $product->id }}</td>
                        <td class="left-border right-border"><img src="{{ asset($product->img_path) }}"></td>
                        <td class="left-border right-border">{{ $product->product_name }}</td>
                        <td class="left-border right-border">¥{{ $product->price }}</td>
                        <td class="left-border right-border">{{ $product->stock }}</td>
                        <td class="left-border right-border">{{ $product->company_name }}</td>
                        <td class="left-border right-border"><a href="{{ route('details', $product->id) }}"><button type="button" class="btn btn-detail">詳細</button></a></td>
                        <td class="left-border">
                            <form action="{{ route('deleteList', $product->id) }}" method="post" onsubmit="return deleteForm()">
                                @csrf
                                <button type="submit" class="btn btn-delete">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $products->links('pagination::default') }}

<script src="{{ asset('/js/list.js') }}"></script>
</body>
</html>