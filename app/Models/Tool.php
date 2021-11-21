<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order() {
        return $this->hasMany(Order::class, 'no_drawing', 'drawing');
    }
}
