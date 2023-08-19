<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sales extends Model
{
    public function salesRegist($data) {
        DB::table('sales')->insert([
            'product_id' => $data,
        ]);

    }
}
