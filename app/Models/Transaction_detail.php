<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    protected $primaryKey = 'id_penjualan_detail';
    protected $guarded = [];

    public function produk()
    {
        return $this->hasOne(Product::class, 'code', 'code');
    }
}
