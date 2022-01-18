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

    public function flowProcess() {
        return $this->hasOne(FlowProcess::class, 'no_drawing', 'drawing');
    }

    public function scopeFilter($query, $filter) {
        return $query->whereDrawing($filter)
                        ->orWhere('cust_code', strtoupper($filter))
                        ->orWhere('code','like', '%' . $filter . '%')
                        ->orWhere('description', 'like', '%' . $filter . '%')
                        ->orWhere('status', strtoupper($filter))
                        ->orWhere('note', 'like', '%' . $filter . '%');
    }

    public static function getDrawingNumber($code, $cust_code) {
        return self::whereCust_code($cust_code)
                        ->whereCode($code)
                        ->orderBy('drawing', 'desc')
                        ->first();
    }

    public static function getByDrawing($drawing) {
        return self::whereDrawing($drawing)->first();
    }
}
