<?php

namespace JoggApp\NaturalLanguage;

use Illuminate\Support\ServiceProvider;

class NaturalLanguageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/naturallanguage.php' => config_path('naturallanguage.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/naturallanguage.php', 'naturallanguage');

        $this->app->bind(NaturalLanguageClient::class, function () {
            return new NaturalLanguageClient(config('naturallanguage'));
        });

        $this->app->bind(NaturalLanguage::class, function () {
            $client = app(NaturalLanguageClient::class);

            return new NaturalLanguage($client);
        });

        $this->app->alias(NaturalLanguage::class, 'laravel-natural-language');
    }
}
