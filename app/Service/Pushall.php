<?php

namespace App\Service;

use GuzzleHttp\Client;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

class Pushall
{
    const MAX_TITLE_LENGTH = 80;
    const MAX_TEXT_LENGTH = 500;

    private $apiKey;
    private $id;

    protected $url = 'https://pushall.ru/api.php';

    public function __construct($apiKey, $id)
    {
        $this->apiKey = $apiKey;
        $this->id = $id;
    }

    /**
     * Отправка уведомления
     * @param $title
     * @param $text
     * @return Response|ResponseInterface
     */
    public function send($title, $text)
    {
        if (mb_strlen($title) > self::MAX_TITLE_LENGTH) {
            $title = mb_strimwidth($title, 0, self::MAX_TITLE_LENGTH - 3, '...');
        }

        if (mb_strlen($text) > self::MAX_TEXT_LENGTH) {
            $text = mb_strimwidth($text, 0, self::MAX_TEXT_LENGTH - 3, '...');
        }

        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'text' => $text,
            'title' => $title
        ];

        return Http::asForm()->post($this->url, $data);
    }
}
