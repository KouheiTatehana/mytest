<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('/css/list.css') }}" rel="stylesheet">
    <title>商品一覧画面</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <h1 class="titleRed">商品一覧画面</h1>
        <div class="form-group">
            <form class="form-desc">
                <div class="product-name-search form-area">
                    <input type="text" class="form-search" name="keyword" placeholder="検索キーワード" id="keyword">
                </div>
                <div class="company-name-area form-area">
                    <select class="form-select" name="makerKeyword" id="selectEach">
                        <option value="">メーカー名</option>
                </select>
                </div>
                <div class="price-search form-area">
                    <label>価格:</label>
                    <input type="number" class="number-input" name="min-price" id="min-price">
                    <span>~</span>
                    <input type="number" class="number-input" name="max-price" id="max-price">
                </div>
                <div class="stock-search form-area">
                    <label>在庫数:</label>
                    <input type="number" class="number-input" name="min-stock" id="min-stock">
                    <span>~</span>
                    <input type="number" class="number-input" name="max-stock" id="max-stock">
                </div>
                <button type="button" class="btn btn-search" onclick="asyncSearch()">検索</button>
            </form>
        </div>

        <div class="table-container">
            <table class="tablesorter" border="1" cellspacing="0" id="table">
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