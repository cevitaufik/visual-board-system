<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowProcess extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['tool'];

    public function tool() {
        return $this->hasOne(Tool::class, 'drawing', 'no_drawing');
    }
}
