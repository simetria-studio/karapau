<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'item',
        'name',
        'price',
        'value',
        'total_value',
        'quantity',
        'image',
        'origem',
        'caixas',
        'user_id',
        'order_id',
        'aceito',
        'caixa_devolvida',
        'status',
        'pescador_id',
        'fatura',
        'deliveryman',
        'anexo',
    ];


    public function orders()
    {
        return $this->belongsTo(UserOrder::class, 'order_id');
    }

    public function pescador()
    {
        return $this->belongsTo(Pescador::class, 'pescador_id');
    }

}
