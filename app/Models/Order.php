<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'no',
        'spg',
        'nama',
        'hp',
        'alamat',
        'ongkir',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
        //return $this->hasMany(Product::class)->withPivot('quantity');
    }
    
//    public function qty()
//     {
//         return $this->belongsTo(OrderProduct::class, 'quantity');
//     }
}
