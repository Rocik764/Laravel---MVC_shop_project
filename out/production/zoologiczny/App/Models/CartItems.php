<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CartItems extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'cart_items';
    protected $fillable = [
        'product_id',
        'user_id',
        'amount'
    ];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function getSubtotal() {
        return $this->product->price * $this->amount;
    }
}
