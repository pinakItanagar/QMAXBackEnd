<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'product_catelogue';
    protected $primaryKey = 'product_ct_id';

    static  function getProductByID($product_id) {

        $product = self::where('product_ct_id', '=',$product_id)
        ->get();
        return $product;

    }
}
