<?php

namespace JoggApp\NaturalLanguage;

use Exception;
use Google\Cloud\Language\LanguageClient;

class NaturalLanguageClient
{
    private $language;

    public function __construct(array $config)
    {
        $this->checkForInvalidConfiguration($config);

        $this->language = new LanguageClient([
            'keyFilePath' => $config['key_file_path'],
            'projectId' => $config['project_id']
        ]);
    }

    public function sentiment(string $text)
    {
        return $this->language
            ->analyzeSentiment($text);
    }

    public function entities(string $text)
    {
        return $this->language
            ->analyzeEntities($text)
            ->entities();
    }

    public function entitySentiment(string $text)
    {
        return $this->language
            ->analyzeEntitySentiment($text)
            ->entities();
    }

    public function syntax(string $text)
    {
        return $this
            ->language
            ->analyzeSyntax($text);
    }

    public function categories(string $text)
    {
        return $this->language
            ->classifyText($text)
            ->categories();
    }

    public function annotateText(string $text, array $features = [])
    {
        return empty($features)
            ? $this->language->annotateText($text)
            : $this->language->annotateText($text, ['features' => $features]);
    }

    private function checkForInvalidConfiguration(array $config)
    {
        if (!file_exists($config['key_file_path'])) {
            throw new Exception('The json file does not exist at the given path');
        }

        if ((!is_string($config['project_id'])) || empty($config['project_id'])) {
            throw new Exception('Please set a valid project id');
        }
    }
}
