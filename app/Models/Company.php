<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    //一覧画面表示
    public function getCompanyList() {
        $companies = DB::table('companies')->get();

        return $companies;
    }
    
    //新規登録画面表示
    public function getCompanySelect() {
        $companies = DB::table('companies')->get();

        return $companies;
    }

    //編集画面表示
    public function getCompanyEdit() {
        $companies = DB::table('companies')->get();

        return $companies;
    }

}
