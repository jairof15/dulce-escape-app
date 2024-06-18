<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'customer_id', 'total'];

    // Definir relación con la tabla customers: una venta pertenece a un cliente
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Definir relación con la tabla sale_details: una venta tiene muchos detalles de venta
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }

    

}
