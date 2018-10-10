# Laravel package for the Google Natural language API

[![Latest Version](https://img.shields.io/github/release/JoggApp/laravel-natural-language.svg?style=flat-rounded)](https://github.com/JoggApp/laravel-natural-language/releases)
[![Build Status](https://travis-ci.org/JoggApp/laravel-natural-language.svg?branch=master)](https://travis-ci.org/JoggApp/laravel-natural-language)
[![Total Downloads](https://img.shields.io/packagist/dt/JoggApp/laravel-natural-language.svg?style=flat-rounded&colorB=brightgreen)](https://packagist.org/packages/JoggApp/laravel-natural-language)

This package makes using the Google Natural API in your laravel app a breeze with minimum to no configuration, clean syntax and a consistent package API. All methods accept a string and return an array: [Docs](https://github.com/JoggApp/laravel-natural-language/#how-to-use)

![nl](https://user-images.githubusercontent.com/11228182/46759910-25027180-ccee-11e8-96e6-af75939267e1.png)

## Installation

- You can install this package via composer using this command:

```bash
composer require joggapp/laravel-natural-language
```

- The package will automatically register itself.

- We have documented how to setup the project and get the necessary configurations from the Google Cloud Platform console in a step by step detailed manner [over here.](https://github.com/JoggApp/laravel-natural-language/blob/master/google.md)

- You can publish the config file using the following command:

```bash
php artisan vendor:publish --provider="JoggApp\NaturalLanguage\NaturalLanguageServiceProvider"
```

This will create the package's config file called `naturallanguage.php` in the `config` directory. These are the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | The id of project created in the Google Cloud Platform console.
    |--------------------------------------------------------------------------
    */
    'project_id' => env('NATURAL_LANGUAGE_PROJECT_ID', 'sample-12345'),

    /*
    |--------------------------------------------------------------------------
    | Path to the json file containing the authentication credentials.
    |--------------------------------------------------------------------------
    */
    'key_file_path' => base_path('composer.json'),
];
```

## How to use

- After setting up the config file values you are all set to use the following methods :smile:

- Detect the Sentiment: Accepts a string and returns an array.

```php
NaturalLanguage::sentiment(string $text): array
```

- Detect the Entities: Accepts a string and returns an array.

```php
NaturalLanguage::entities(string $text): array
```

- Detect the Sentiment per entity basis: Accepts a string and returns an array.

```php
NaturalLanguage::entitySentiment(string $text): array
```

- Detect the syntax: Accepts a string and returns an array.

```php
NaturalLanguage::syntax(string $text): array
```

- Detect the categories: Accepts a string and returns an array.

```php
NaturalLanguage::categories(string $text): array
```

- Annotate text: Accepts a string and an optional `features` array & returns an array.

```php
NaturalLanguage::annotateText(string $text, array $features = ['sentiment', 'syntax']): array
```

## Credits

- [Harish Toshniwal](https://github.com/introwit)
- [All Contributors](../../contributors)

## Testing

You can run the tests with:

```bash
vendor/bin/phpunit
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Security

If you discover any security related issues, please email them to [harish@jogg.co](mailto:harish@jogg.co) instead of using the issue tracker.

## License

The MIT License (MIT). Please see the [License File](LICENSE.txt) for more information.
