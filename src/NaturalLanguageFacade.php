<?php

namespace JoggApp\NaturalLanguage;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JoggApp\NaturalLanguage\NaturalLanguage
 */
class NaturalLanguageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-natural-language';
    }
}
