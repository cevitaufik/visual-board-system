<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['job_type'];

    // untuk menghubungkan dua kelas
    // buat function yang namanya sama dengan kelas yang akan dihubungkan
    // untu mengecek
    // 1. php artisan tinker
    // 2. $order = Order::first()
    // 3. $order->jobType // menanggil function yang telah dibuat
    public function jobType() {
        return $this->belongsTo(JobType::class);
    }
}
