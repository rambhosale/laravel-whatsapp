<?php

namespace Rambhosale\LaravelWhatsapp\Data;

use Rambhosale\LaravelWhatsapp\Interfaces\HasMessageData;

abstract class InteractiveMessageData implements HasMessageData
{
    public function getType()
    {
        return 'interactive';
    }
}
