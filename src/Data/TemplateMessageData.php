<?php

namespace Rambhosale\LaravelWhatsapp\Data;

use Rambhosale\LaravelWhatsapp\Interfaces\HasMessageData;

class TemplateMessageData implements HasMessageData
{
    public function __construct(private string $templateName, private string $languageCode = 'en_US')
    {
    }

    public function getType(): string
    {
        return 'template';
    }

    public function toArray(): array
    {
        return [
            'name'     => $this->templateName,
            'language' => [
                'code' => $this->languageCode,
            ],
        ];
    }

    public function toJson($options = 0) : string
    {
        return json_encode($this->toArray(), $options);
    }
}
