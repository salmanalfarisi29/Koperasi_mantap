<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Product extends Model
{
    use LogsActivity;

    use HasFactory;

    protected $table = "products";
    protected $fillable = [
        'code',
        'product_name',
        'quantity', 
        'price'
    ];
   
    public function getActivitylogOptions(): LogOptions
{
    return LogOptions::defaults();
}

    protected static $logName = 'barang';
    protected static $logFillable = true;
}
