<?php

/*
|--------------------------------------------------------------------------
| How to get both the below config values is documented in a step by step
| detailed manner over here:
| https://github.com/JoggApp/laravel-natural-language/blob/master/google.md
|--------------------------------------------------------------------------
*/

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
