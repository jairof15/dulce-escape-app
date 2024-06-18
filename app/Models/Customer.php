<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['name', 'last_name', 'document', 'document_type','email', 'phone', 'address'];

    // Definir relación con la tabla sales: un cliente tiene muchas ventas
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}
