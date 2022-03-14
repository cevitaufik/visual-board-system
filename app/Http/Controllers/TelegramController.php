<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }


    public function messages() {
        return $this->telegram->getUpdates();
    }

    public function sendMessage($id) {
        return $this->telegram->sendMessage([
            'chat_id' => $id, 
            'text' => 'Hello.....'
        ]);
    }

    public function webhook() {
        $update = $this->telegram->getWebhookUpdate();

        if (isset($update['message'])) {
            $text = $update['message']['text'];
            $id = $update['message']['from']['id'];

            $this->telegram->sendMessage([
                'chat_id' => $id, 
                'text' => 'ini adalah pesan balasan dari "' . $text . '".'
            ]);
        };
    }
}
