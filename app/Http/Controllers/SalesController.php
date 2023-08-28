<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Support\Facades\DB;



class SalesController extends Controller
{
    public function salesManage(Request $request) {

        DB::beginTransaction();

        try {
            $documents = new Product();
            $model = new Sales();
    
            //Postmanから送られてきたデータ取得
            $productData = $request->product_name;
    
            //購入する商品のID・在庫数取得
            $products = $documents->getProductData($productData);
            $productId = $products->id;
            $productStock = $products->stock;
            $returnMessage = "";
    
            if ($productStock >= 1) {
                //取得した商品IDをSalesテーブルへレコード追加
                $model->salesRegist($productId);
    
                //購入した商品の在庫数を減らす
                $documents->stockUpdate($productId);
    
                $returnMessage = "購入完了";
    
            } elseif ($productStock === 0) {
                $returnMessage = "在庫がありません。";
            }

            DB::commit();
        
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return response()->json($returnMessage);

    }
}
