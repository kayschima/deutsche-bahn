<?php

namespace Kayschima\DeutscheBahn\Facades;

use Illuminate\Support\Facades\Facade;

class DeutscheBahn extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'deutsche-bahn';
    }
}
