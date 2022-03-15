<?php

namespace app\Helpers\Telegram\Commands;

use App\Models\Order;

class TelegramCommands {

  private string $function;
  private string $keyword;

  function __construct($function, $keyword)
  {
    $this->keyword = $keyword;
    $this->function = $function;
  }

  function so() {
    $order = Order::whereShop_order($this->keyword)->first();

    if ($order) {
      return $order->description;
    } else {
      return 'Shop order tidak ditemukan';
    }
  }

  public function text() {
    $fn = $this->function;
    return $this->$fn();
  }

  // public function search() {
  //   if ($this->filter == '') {
  //       return back();
  //   } else {
  //       $fltr = $this->filter;
  //       return $this->$fltr();
  //   }
  // }
}