<?php

namespace App\Service;

use GuzzleHttp\Client;

class Pushall
{
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
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($title, $text)
    {
        $data = [
            'type' => 'self',
            'id' => $this->id,
            'key' => $this->apiKey,
            'text' => $text,
            'title' => $title
        ];

        $client = new Client(['base_uri' => $this->url]);

        return $client->post('', ['form_params' => $data]);
    }
}
