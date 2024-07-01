<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'product_name', 'product_price', 'expired_date', 'image'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}


// class Product extends Model
// {
//     use HasFactory;
// }
