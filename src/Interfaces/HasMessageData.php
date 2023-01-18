<?php

namespace Rambhosale\LaravelWhatsapp\Interfaces;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

interface HasMessageData extends Arrayable, Jsonable
{
    /** @return string */
    public function getType();
}
