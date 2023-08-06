
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
                        <td class="left-border right-border" id="imgArea"><img src="{{ asset('strage/sample/' . ${val.img_path}) }}"></td>
                        <td class="left-border right-border" id="productNameArea">${val.product_name}</td>
                        <td class="left-border right-border" id="priceArea">¥${val.price}</td>
                        <td class="left-border right-border" id="stockArea">${val.stock}</td>
                        <td class="left-border right-border" id="companyNameArea">${val.company_name}</td>
                        <td class="left-border right-border"><a href="{{ route('details', ${val.id}) }}"><button type="button" class="btn btn-detail">詳細</button></a></td>
                        <td class="left-border">
                            <form class="deleteForm">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-delete" data-product-id="${val.id}">削除</button>
                            </form>
                        </td>
                    </tr>
            `;
            $("#bodyWrapper").append(html);
        });
    
        $.each(companies, function(index, value){
            htmlSelect = `<option value="${value.id}">${value.company_name}</option>`;
            $("#selectEach").append(htmlSelect);
        });
    })
    
    .fail(function(){
        alert('エラー');
    });
    
});


//検索機能


//削除処理
$(function(){
    $('.btn-delete').on('click', function(){
        let deleteConfirm = confirm('本当に削除しますか？');

        let clickDelete = $(this)
        let userID = clickDelete.attr('data-product-id');

        // $.ajaxSetup({
        // });

        if (deleteConfirm == true){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'delete',
                type: 'POST',
                cache: false,
                // dataType: 'json',
                data: {id: userID, '_method': 'DELETE'}  
                     
            })

            .done(function(){
                clickDelete.parents('.row-body').remove();
            })

            .fail(function(){
                alert('削除できませんでした。');   
            })    


        } else {
            (function(e){
                e.preventDefault();
            });
        };
    });
});