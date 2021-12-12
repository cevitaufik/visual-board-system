<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['customer'];

    public function customer() {
        return $this->hasOne(Customer::class, 'code', 'cust_code');
    }
}
