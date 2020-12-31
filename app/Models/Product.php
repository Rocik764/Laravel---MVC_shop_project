<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'category_id',
        'producent_id',
        'subcategory_id'
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function producent() {
        return $this->belongsTo('App\Models\Producent');
    }

    public function subcategory() {
        return $this->belongsTo('App\Models\Subcategory');
    }
}
