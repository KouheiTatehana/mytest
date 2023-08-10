<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\NewRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\New_;

class ProductController extends Controller
{
    //一覧画面表示
    public function showList(Request $request) {

        if ($request->ajax()) {
            $model = new Product();
            $products = $model->getList();
    
            $documents = new Company();
            $companies = $documents->getCompanyList();

            /*echo json_encode([
                'products' => $products,
                'companies' => $companies
            ]);*/

            return response()->json([
                'products' => $products,
                'companies' => $companies,
            ]);
    
        } else {
            return view('list');
        }

    }

    //検索機能⇒一覧画面表示
    public function showSearchList(Request $request) {
        $model = new Product();
        $keyword = $request->keyword;
        $makerKeyword = $request->makerKeyword;

        $products = $model->searchList($keyword, $makerKeyword);

        $documents = new Company();
        $companies = $documents->getCompanyList();

        return response()->json([
            'products' => $products,
            'companies' => $companies,
        ]);
    }

    //新規登録画面表示
    public function showRegistForm() {
        $model = new Company();
        $companies = $model->getCompanySelect();

        return view('regist', ['companies' => $companies]);
    }

    //登録処理
    public function registSubmit(NewRequest $request) {
        
        if ($request->img_path) {
            $file_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->storeAs('public/sample', $file_name);
        }

        DB::beginTransaction();

        try {
            
            $model = new Product();
            
            if ($request->img_path) {
                $model->registProduct($request, $file_name);
            } else {
                $model->registProductOnly($request);
            }

            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('new'));

    }

    //詳細画面表示
    public function showDetail($id) {
        $model = new Product();
        $products = $model->getDetail($id);

        return view('detail', ['products' => $products]);
    }

    //編集画面表示
    public function showEdit($id) {
        $model = new Product();
        $products = $model->getEdit($id);

        $documents = new Company();
        $companies = $documents->getCompanyEdit();

        return view('edit', [
            'products' => $products,
            'companies' => $companies
        ]);
    }

    //更新（編集）処理
    public function updateSubmit(UpdateRequest $request, $id) {

        if ($request->productImg) {
            $file_name = $request->file('productImg')->getClientOriginalName();
            $request->file('productImg')->storeAs('public/sample', $file_name);
        }

        DB::beginTransaction();

        try {

            $model = new Product();

            if ($request->productImg) {
                $model->updateProduct($request, $id, $file_name);
            } else {
                $model->updateProductOnly($request, $id);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        return redirect(route('edit', $id));
    }


    //削除処理
    public function deleteSubmit(Request $request) {
        $model = new Product();
        $deleteId = $request->id;
        $model->deleteProduct($deleteId);
        // return view('list');
    }

}
