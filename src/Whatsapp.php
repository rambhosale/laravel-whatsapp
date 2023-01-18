<?php

namespace Rambhosale\LaravelWhatsapp;

use GuzzleHttp\ClientInterface;
use Rambhosale\LaravelWhatsapp\Data\ResponseData;
use Rambhosale\LaravelWhatsapp\Exceptions\FailedConnectionException;
use Rambhosale\LaravelWhatsapp\Exceptions\MessageNotSetException;
use Rambhosale\LaravelWhatsapp\Interfaces\HasMessageData;

class Whatsapp
{
    /** @var string */
    private $token;

    /** @var string */
    private $phoneId;

    /** @var string */
    private $to;

    /** @var HasMessageData|null */
    private $message;

    /** @var ClientInterface */
    private $client;

    /** @param ?ClientInterface $client */
    public function __construct($client = null)
    {
        $this->client = $client ?? new \GuzzleHttp\Client();
    }

    public static function make($client = null): self
    {
        return (new static($client))
            ->token(config('whatsapp.token'))
            ->phoneId(config('whatsapp.phone_id'));
    }

    public function phoneId($phoneId): self
    {
        $this->phoneId = $phoneId;

        return $this;
    }

    public function token($token): self
    {
        $this->token = $token;

        return $this;
    }

    public function to($to): self
    {
        $this->to = $to;

        return $this;
    }

    /** @param HasMessageData $message */
    public function message($message): self
    {
        $this->message = $message;

        return $this;
    }

    /** @return ?ResponseData */
    public function send()
    {
        if (is_null($this->message)) {
            throw new MessageNotSetException();
        }

        $response = $this->client->request('POST', $this->defineBaseUrl() . '/messages', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'recipient_type'          => 'individual',
                'messaging_product'       => 'whatsapp',
                'to'                      => $this->to,
                'type'                    => $this->message->getType(),
                $this->message->getType() => $this->message->toArray(),
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw FailedConnectionException::couldNotConnect();
        }

        return ResponseData::fromArray(json_decode($response->getBody(), true));
    }

    public function markAsRead($messageId): void
    {
        $response = $this->client->request('POST', $this->defineBaseUrl() . '/messages', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'messaging_product' => 'whatsapp',
                'status'            => 'read',
                'message_id'        => $messageId,
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw FailedConnectionException::couldNotConnect();
        }
    }

    protected function defineBaseUrl(): string
    {
        return 'https://graph.facebook.com/v15.0/' . $this->phoneId;
    }
}
