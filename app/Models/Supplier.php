<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','image','description'];

    public function addTransaction(){
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function removeTransaction(){
        return $this->hasMany(ProductRemoveTransaction::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }


}
