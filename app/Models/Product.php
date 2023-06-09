<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','supplier_id','brand_id','slug','name','image','description','buy_price','discount_price','sale_price','total_quantity','like_count','view_count'];
    
    protected $appends  = ['image_url'];

    public function getImageUrlAttribute(){
        return asset('/images/'.$this->image);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function color(){
        return $this->belongsToMany(Color::class,'product_color');

    }

    public function addTransaction(){
        return $this->hasMany(ProductAddTransaction::class);
    }

    public function removeTransaction(){
        return $this->hasMany(ProductRemoveTransaction::class);
    }

    public function cart(){
        return $this->hasMany(ProductCart::class);
    }

    public function order(){
        return $this->hasMany(ProductOrder::class);
    }

    public function review(){
        return $this->hasMany(ProductReview::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}
