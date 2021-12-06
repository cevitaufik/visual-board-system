<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['flowProcesses'];

    public function order() {
        return $this->hasMany(Order::class, 'no_drawing', 'drawing');
    }

    public function flowProcesses() {
        return $this->hasMany(FlowProcess::class, 'no_drawing', 'drawing');
    }
}
