<?php

namespace Rambhosale\LaravelWhatsapp\Data;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Rambhosale\LaravelWhatsapp\Traits\HasTypes;

class EmailData implements Arrayable, Jsonable
{
    use HasTypes;

    public $email;
}
