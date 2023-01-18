<?php

namespace Rambhosale\Whatsapp\Data;

use Rambhosale\Whatsapp\Interfaces\HasMessageData;

abstract class InteractiveMessageData implements HasMessageData
{
    public function getType()
    {
        return 'interactive';
    }
}
