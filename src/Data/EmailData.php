<?php

namespace Rambhosale\Whatsapp\Data;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Rambhosale\Whatsapp\Traits\HasTypes;

class EmailData implements Arrayable, Jsonable
{
    use HasTypes;

    public $email;
}
