<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['order'];

    public function order() {
        return $this->hasMany(Order::class, 'cust_code', 'code');
    }
}
