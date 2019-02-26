<?php

namespace JoggApp\NaturalLanguage\Tests;

use Google\Cloud\Language\Annotation;
use JoggApp\NaturalLanguage\NaturalLanguage;
use JoggApp\NaturalLanguage\NaturalLanguageClient;
use JoggApp\NaturalLanguage\Verdict;
use Mockery;
use PHPUnit\Framework\TestCase;

class NaturalLanguageTest extends TestCase
{
    public $testString = 'Laravel is the best';

    private $languageClient;

    private $language;

    public function setUp(): void
    {
        parent::setUp();

        $this->languageClient = Mockery::mock(NaturalLanguageClient::class);

        $this->language = new NaturalLanguage($this->languageClient);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_can_detect_the_sentiment_of_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('sentiment')->with($this->testString)
            ->once()
            ->andReturn(['score' => 0.8, 'magnitude' => 0.8]);

        $response = $this->language->sentiment($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('verdict', $response);
        $this->assertArrayHasKey('score', $response);
        $this->assertArrayHasKey('magnitude', $response);
    }

    /** @test */
    public function it_gives_the_correct_verdict_based_on_the_score_and_magnitude_of_the_sentiment_of_a_string()
    {
        $verdict = $this->language->prepareVerdict(0.8, 10);
        $this->assertEquals(Verdict::VERY_POSITIVE, $verdict);

        $verdict = $this->language->prepareVerdict(-0.8, 10);
        $this->assertEquals(Verdict::VERY_NEGATIVE, $verdict);

        $verdict = $this->language->prepareVerdict(0.8, 0.10);
        $this->assertEquals(Verdict::MOSTLY_POSITIVE, $verdict);

        $verdict = $this->language->prepareVerdict(-0.8, 0.10);
        $this->assertEquals(Verdict::MOSTLY_NEGATIVE, $verdict);

        $verdict = $this->language->prepareVerdict(0.0, 0.0);
        $this->assertEquals(Verdict::MIXED_AND_NEUTRAL, $verdict);
    }

    /** @test */
    public function it_can_detect_the_entities_from_the_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('entities')->with($this->testString)
            ->once()
            ->andReturn([]);

        $response = $this->language->entities($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('entities', $response);
    }

    /** @test */
    public function it_can_detect_the_sentiment_per_entity_from_the_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('entitySentiment')->with($this->testString)
            ->once()
            ->andReturn([]);

        $response = $this->language->entitySentiment($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('entities', $response);
    }

    /** @test */
    public function it_can_detect_the_syntax_from_the_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('syntax')->with($this->testString)
            ->once()
            ->andReturn((new Annotation));

        $response = $this->language->syntax($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('sentences', $response);
        $this->assertArrayHasKey('tokens', $response);
        $this->assertArrayHasKey('language', $response);
    }

    /** @test */
    public function it_can_detect_the_categories_from_the_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('categories')->with($this->testString)
            ->once()
            ->andReturn([]);

        $response = $this->language->categories($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('categories', $response);
    }

    /** @test */
    public function it_can_annotate_the_string_passed_to_it()
    {
        $this->languageClient
            ->shouldReceive('annotateText')->withArgs([$this->testString, []])
            ->once()
            ->andReturn();

        $response = $this->language->annotateText($this->testString);

        $this->assertInternalType('array', $response);

        $this->assertArrayHasKey('text', $response);
        $this->assertArrayHasKey('sentences', $response);
        $this->assertArrayHasKey('tokens', $response);
        $this->assertArrayHasKey('entities', $response);
        $this->assertArrayHasKey('sentiment', $response);
        $this->assertArrayHasKey('categories', $response);
        $this->assertArrayHasKey('language', $response);
    }
}
