<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{

    //一覧画面表示
    public function getList() {
        $products = DB::table('products')
            ->select('products.*', 'companies.company_name')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->get();

        return $products;
    }


    //検索処理
    public function searchList($data1, $data2) {
        /*if (!empty($data)) {
            $products = DB::table('products')
                ->select('products.*', 'companies.company_name')
                ->join('companies', 'company_id', '=', 'companies.id')
                ->where('product_name', 'like', "%{$data->keyword}%")
                ->where('company_id', '=', $data->makerKeyword)
                ->paginate(10);
        }*/

        $products = DB::table('products')
        ->select('products.*', 'companies.company_name')
        ->join('companies', 'company_id', '=', 'companies.id')
        ->where('product_name', 'like', "%{$data1}%")
        ->where('company_id', '=', $data2)
        ->get();
        
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