<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sale_details';

    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price', 'total'];

    // Definir relación con la tabla sales: un detalle de venta pertenece a una venta
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    // Definir relación con la tabla products: un detalle de venta pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Calcular el total del detalle de venta
    public function calculateTotal()
    {
        return $this->quantity * $this->price;
    }

    // Calcular el total de la venta
    public function calculateSaleTotal()
    {
        return $this->sale->saleDetails->sum('total');
    }


}
