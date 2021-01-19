<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'purchase_date',
        'is_completed',
        'address',
        'invoice',
        'phone',
        'comment',
        'delivery',
        'payment',
        'total_price',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
