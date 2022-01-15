<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class FlowProcess extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['tool'];

    private $order;

    function __construct() {
        $this->order = new Order;
    }

    public function tool() {
        return $this->hasOne(Tool::class, 'drawing', 'no_drawing');
    }

    public function getByDrawing($no_drawing) {
        return $this->whereNo_drawing($no_drawing)->first();
    }

    public function copyToOrder($shop_order, $no_drawing): void {
        $order = $this->order->getByShopOrder($shop_order);

        if ($this->getByDrawing($no_drawing)) {
            $flow_process = unserialize($this->getByDrawing($no_drawing)->process);

            foreach ($flow_process as $pk => $processes) {
                foreach ($processes as $ck => $process) {
                    $flow_process[$pk][$ck]['start'] = null;
                    $flow_process[$pk][$ck]['end'] = null;
                    $flow_process[$pk][$ck]['qty'] = null;
                    $flow_process[$pk][$ck]['status'] = 'open';
                    $flow_process[$pk][$ck]['processed_by'] = null;
                }
            }

            $order->update(['flow_process' => serialize($flow_process)]);
        }
    }
}
