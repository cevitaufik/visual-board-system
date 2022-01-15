<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['tool', 'jobType'];

    // untuk menghubungkan dua kelas
    // buat function yang namanya sama dengan kelas yang akan dihubungkan
    // untu mengecek
    // 1. php artisan tinker
    // 2. $order = Order::first()
    // 3. $order->jobType // menanggil function yang telah dibuat
    public function jobType() {

        // memasukan kolom code pada tabel job_types sebagai acuan
        // foreign key kolom job_type_code pada tabel order
        return $this->hasOne(JobType::class, 'code', 'job_type_code');
    }

    public function tool() {
        return $this->hasOne(Tool::class, 'drawing', 'no_drawing');
    }

    public function customer() {
        return $this->hasOne(Customer::class, 'code', 'cust_code');
    }

    public function scopeFilter($query, $filter) {

        return $query->whereShop_order($filter)
                        ->orWhere('po_number','like', '%' . $filter . '%')
                        ->orWhere('cust_code', strtoupper($filter))
                        ->orWhere('description', 'like', '%' . $filter . '%')
                        ->orWhere('note', 'like', '%' . $filter . '%')                        
                        ->orWhere('tool_code', 'like', '%' . $filter . '%')                        
                        ->orWhere('no_drawing', strtoupper($filter))
                        ->orWhere('job_type_code', strtoupper($filter));
    }

    function getByShopOrder($shop_order) {
        return $this->whereShop_order($shop_order)->first();
    }

}