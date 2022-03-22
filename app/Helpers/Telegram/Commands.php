<?php

namespace app\Helpers\Telegram\Commands;

use App\Models\Order;
use Illuminate\Support\Arr;

class TelegramCommands {

  private string $function;
  private string $keyword;
  private array $commands;

  function __construct($function, $keyword)
  {
    $this->keyword = $keyword;
    $this->function = $function;

    // registrasikan semua command disini
    // supaya bisa digunakan dan muncul pada command /help
    $this->commands = [
      'help' => 'Menampilkan semua perintah yang tersedia',
      'so' => 'Mengecek deskripsi nomor dari sebuah SO',
      'duedateso' => 'Mengecek target kirim sebuah SO',
    ];
  }

  function so() {
    $order = Order::whereShop_order($this->keyword)->first();

    if ($order) {
      return $order->description;
    } else {
      return 'Shop order tidak ditemukan';
    }
  }

  function duedateso() {
    $order = Order::whereShop_order($this->keyword)->first();

    if ($order) {
      return 'Target selesai: ' . date('d F Y', strtotime($order->due_date));
    } else {
      return 'Shop order tidak ditemukan';
    }
  }

  function help() {
    $response = '';

    foreach ($this->commands as $command => $description) {
      $response .= '/<b>' . $command . '</b> - ' . $description . PHP_EOL;
    }

    $response .= PHP_EOL;
    $response .= 'contoh: ' . PHP_EOL;
    $response .= '/so 211109002' . PHP_EOL;

    return $response;
  }

  public function text() {
    $fn = $this->function;

    if (Arr::exists($this->commands, $fn)) {
      return $this->$fn();
    } else {
      return 'Perintah tidak ditemukan, gunakan perintah /help untuk melihat daftar perintah.';
    }
    
  }
}