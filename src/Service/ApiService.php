<?php
namespace App\Service;
use Symfony\Component\HttpClient\HttpClient;


class ApiService
{
    public function apiTest()
    {
        $client = HttpClient::create();
        for ($i = 0; $i < 3; $i++) {
            $num = str_pad(mt_rand(1, 999999), 7, '0', STR_PAD_LEFT);
            $response = $client->request('GET', 'http://www.omdbapi.com/?i=tt' . $num . '&apikey=7ae878bc');
            $api = $response->toArray();
            $contents[] = $api;
        }
        return $contents;
    }

    public function same($num)
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'http://www.omdbapi.com/?i=' . $num . '&apikey=7ae878bc');
        $content = $response->toArray();
        return $content;
    }
}