<?php

namespace Rambhosale\LaravelWhatsapp\Facades;

use Illuminate\Support\Facades\Facade;

class Whatsapp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-whatsapp';
    }
}
