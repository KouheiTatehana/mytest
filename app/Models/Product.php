<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{

    use Sortable;
    public $sortable = ['id', 'product_name', 'price', 'stock', 'company_name'];

    //一覧画面表示
    public function getList() {
        $products = DB::table('products')
            ->select('products.*', 'companies.company_name')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->sortable()
            ->get();

        return $products;
    }


    //検索処理
    public function searchList($keyword, $makerKeyword, $minPrice, $maxPrice, $minStock, $maxStock) {

        /*$products = DB::table('products')
        ->join('companies', 'company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->where('products.product_name', 'like', "%{$data1}%")
        ->orWhere('products.company_id', '=', $data2)
        ->get();*/

        $product = DB::table('products')
        ->join('companies', 'company_id', '=', 'companies.id')
        ->select('products.id','products.company_id', 'products.product_name', 'products.price', 'products.stock', 'products.comment', 'products.img_path', 'companies.company_name');

        if (!empty($keyword)) {
            $product->where('products.product_name', 'like', "%{$keyword}%");
        }

        if (!empty($makerKeyword)) {
            $product->where('products.company_id', '=', $makerKeyword);
        }

        if ($minPrice && $maxPrice) {
            $product->whereBetween('products.price', [$minPrice, $maxPrice]);
        } elseif ($minPrice) {
            $product->where('products.price', '>=', $minPrice);
        } elseif ($maxPrice) {
            $product->where('products.price', '<=', $maxPrice);
        }

        if ($minStock && $maxStock) {
            $product->whereBetween('products.stock', [$minStock, $maxStock]);
        } elseif ($minStock) {
            $product->where('products.stock', '>=', $minStock);
        } elseif ($maxStock) {
            $product->where('products.stock', '<=', $maxStock);
        }


        $products = $product->get();
        
        return $products;
    }


    //登録処理
    public function registProduct($data, $sample) {
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
            'img_path' => 'strage/sample/' . $sample,
        ]);
    }

    public function registProductOnly($data) {
        DB::table('products')->insert([
            'product_name' => $data->product_name,
            'company_id' => $data->company_name,
            'price' => $data->price,
            'stock' => $data->stock,
            'comment' => $data->comment,
        ]);
    }


    //詳細画面表示
    public function getDetail($id) {
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

            return $products;
    }


    //編集画面表示
    public function getEdit($id) {
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id', '=', $id)
            ->first();

        return $products;
    }


    //更新（編集）処理
    public function updateProduct($data, $id, $sample) {
        DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'product_name' => $data->productName,
                'company_id' => $data->productMaker,
                'price' => $data->productPrice,
                'stock' => $data->productStock,
                'comment' => $data->productComment,
                'img_path' => 'strage/sample/' . $sample,
            ]);
    }

    public function updateProductOnly($data, $id) {
        DB::table('products')
            ->where('id', '=', $id)
            ->update([
                'product_name' => $data->productName,
                'company_id' => $data->productMaker,
                'price' => $data->productPrice,
                'stock' => $data->productStock,
                'comment' => $data->productComment,    
            ]);
    }

    //削除処理
    public function deleteProduct($id) {
        DB::table('products')
            ->where('id', '=', $id)
            ->delete();
    }
}