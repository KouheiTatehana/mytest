
//一覧表示
$(document).ready(function(){
    $.ajax({
        url: 'list',
        type: 'GET',
        cache: false,
        dataType: 'json'

    })

    .done(function(data){

        let products = data.products;
        let companies = data.companies;

        $.each(products, function(index, val){
            html = `<tr class="row-body" id="rowWrapper">
                        <td class="right-border" id="idArea">${val.id}</td>
                        <td class="left-border right-border" id="imgArea"><img src="http://localhost/myproject/public/strage/sample/${val.img_path}"></td>
                        <td class="left-border right-border" id="productNameArea">${val.product_name}</td>
                        <td class="left-border right-border" id="priceArea">¥${val.price}</td>
                        <td class="left-border right-border" id="stockArea">${val.stock}</td>
                        <td class="left-border right-border" id="companyNameArea">${val.company_name}</td>
                        <td class="left-border right-border"><a href="http://localhost/myproject/public/detail/${val.id}"><button type="button" class="btn btn-detail">詳細</button></a></td>
                        <td class="left-border">
                            <form class="deleteForm">
                                <button type="button" class="btn btn-delete" data-product-id="${val.id}" onclick="deleteMethod(this, ${val.id})">削除</button>
                            </form>
                        </td>
                    </tr>
            `;
            $("#bodyWrapper").append(html);
        });
    
        $.each(companies, function(index, val){
            htmlSelect = `<option value="${val.id}">${val.company_name}</option>`;
            $("#selectEach").append(htmlSelect);
        });
    })
    
    .fail(function(){
        alert('エラー');
    });
    
});


//検索機能
function asyncSearch() {
    
    let keyword1 = $("#keyword").val();
    let keyword2 = $("#selectEach").val();
    let keyword3 = $("#min-price").val();
    let keyword4 = $("#max-price").val();
    let keyword5 = $("#min-stock").val();
    let keyword6 = $("#max-stock").val();


    $("#bodyWrapper").empty();


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'list',
        type: 'POST',
        cache: false,
        dataType: 'json',
        data: {
            'keyword': keyword1,
            'makerKeyword': keyword2,
            'minPrice': keyword3,
            'maxPrice': keyword4,
            'minStock': keyword5,
            'maxStock': keyword6,
        }
    })

    .done(function(data){
        let products = data.products;
        let companies = data.companies;

        $.each(products, function(index, val){
            html = `<tr class="row-body" id="rowWrapper">
                        <td class="right-border" id="idArea">${val.id}</td>
                        <td class="left-border right-border" id="imgArea"><img src="http://localhost/myproject/public/strage/sample/${val.img_path}"></td>
                        <td class="left-border right-border" id="productNameArea">${val.product_name}</td>
                        <td class="left-border right-border" id="priceArea">¥${val.price}</td>
                        <td class="left-border right-border" id="stockArea">${val.stock}</td>
                        <td class="left-border right-border" id="companyNameArea">${val.company_name}</td>
                        <td class="left-border right-border"><a href="http://localhost/myproject/public/detail/${val.id}"><button type="button" class="btn btn-detail">詳細</button></a></td>
                        <td class="left-border">
                            <form class="deleteForm">
                                <button type="button" class="btn btn-delete" data-product-id="${val.id}" onclick="deleteMethod(this, ${val.id})">削除</button>
                            </form>
                        </td>
                    </tr>
            `;
            $("#bodyWrapper").append(html);
        });
    })

    .fail(function(){
        alert('エラー');
    });
    
}


//削除処理
function deleteMethod(btn, id) {
    let deleteConfirm = confirm('本当に削除しますか？');

    if (deleteConfirm == true){

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'delete',
            type: 'POST',
            cache: false,
            data: {id: id, '_method': 'DELETE'}
                 
        })

        .done(function(){
            $(btn).parents('.row-body').remove();
        })

        .fail(function(){
            alert('削除できませんでした。');   
        })    


    } else {
        (function(e){
            e.preventDefault();
        });
    };

}