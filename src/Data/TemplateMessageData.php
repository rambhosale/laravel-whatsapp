<?php

namespace Rambhosale\LaravelWhatsapp\Data;

use Rambhosale\LaravelWhatsapp\Interfaces\HasMessageData;

class TemplateMessageData implements HasMessageData
{
    private $name;
    private $languageCode;

    public function getType()
    {
        return 'template';
    }

    public function toArray()
    {
        return [];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}
