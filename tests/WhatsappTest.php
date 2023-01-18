<?php

use GuzzleHttp\Psr7\Response;
use Rambhosale\LaravelWhatsapp\Data\ResponseData;
use Rambhosale\LaravelWhatsapp\Data\TextMessageData;
use Rambhosale\LaravelWhatsapp\Whatsapp;

beforeEach(function () {
});

it('can send Text Message Data', function () {
    $client = createFakeClient([
        new Response(200, [], file_get_contents('tests/stubs/response_message_200.json')),
    ]);

    $response = Whatsapp::make($client)
        ->token('token')
        ->phoneId('phoneId')
        ->to('+62000000000')
        ->message(TextMessageData::make('Hello World'))
        ->send();

    expect($response)
        ->toBeInstanceOf(ResponseData::class)
        ->and($response->contacts)->toBeArray()
        ->and($response->messages)->toBeArray()
        ->and($response->messagingProduct)->toBe('whatsapp');
});
