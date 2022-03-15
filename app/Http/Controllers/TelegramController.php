<?php

namespace App\Http\Controllers;

use app\Helpers\Telegram\Commands\TelegramCommands;
use Telegram\Bot\Api;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    private $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    /*
    contoh pesan:

    [
        {
            "update_id":617452676,
            "message": { 
                "message_id":27,
                "from": {
                    "id":5178813252,
                    "is_bot":false,
                    "first_name":"Cevi",
                    "language_code":"en"
                },
                "chat": {
                    "id":5178813252,
                    "first_name":"Cevi",
                    "type":"private"
                },
                "date":1647340251,
                "text":"tess"
            }
        }
    ]

    */

    // mengambil pesan secara manual
    // hanya akan berjalan juka webhook tidak aktif
    public function messages() {
        return $this->telegram->getUpdates();
    }

    // mengirim pesan secara manual
    public function sendMessage($id) {
        return $this->telegram->sendMessage([
            'chat_id' => $id, 
            'text' => 'Hello.....'
        ]);
    }

    // membuat webhook
    public function setWebhook() {
        $this->telegram->setWebhook([
            // 'url' =>  env('APP_URL') . '/telegram/bf9yXfMVxc43Z5TVF54kcujAJG4sRQ7JTG5udmCw3Ts3mrEwqHBCM8Mx6kFzTQcj/webhook'
            'url' =>  env('URL_NGROK') . '/telegram/bf9yXfMVxc43Z5TVF54kcujAJG4sRQ7JTG5udmCw3Ts3mrEwqHBCM8Mx6kFzTQcj/webhook'
        ]);

        return ['message' => 'Webhook telah di setting'];
    }

    // menghapus webhook
    public function removeWebhook() {
        $this->telegram->removeWebhook();
        return ['message' => 'Webhook telah dihapus'];
    }

    // penjawab otomatis
    public function autoResponse($token, Request $request) {

        $id = $request['message']['from']['id'];
        $text = substr($request['message']['text'], 1);
        $textExploded = explode(' ', $text);

        $reply = new TelegramCommands($textExploded[0], $textExploded[1]);

        $this->telegram->sendMessage([
                    'chat_id' => $id, 
                    'text' => $reply->text(),
                ]);
    }
}
