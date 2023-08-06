<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/css/list.css') }}" rel="stylesheet">
    <title>商品一覧画面</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <h1 class="titleRed">商品一覧画面</h1>
        <div class="form-group">
            <form class="form-desc" action="{{ route('listSearch') }}" method="post">
            @csrf
                <input type="text" class="form-search" name="keyword" placeholder="検索キーワード">
                <select class="form-select" name="makerKeyword" id="selectEach">
                    <option value="選択されていません">メーカー名</option>

                </select>
                <input type="submit" class="btn btn-search" value="検索">
            </form>
        </div>

        <div class="table-container">
            <table class="table" border="1" cellspacing="0">
                <thead class="product-head">
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
                <tbody class="product-body" id="bodyWrapper">
                    
                </tbody>
            </table>
        </div>
    </div>
    {{-- {{ $products->links('pagination::default') }} --}}

<script src="{{ asset('/js/list.js') }}"></script>
</body>
</html>