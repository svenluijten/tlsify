<?php

namespace Sven\TlsChecker\Tests\Feature;

use Sven\TlsChecker\DirectoryCrawler;
use Sven\TlsChecker\Regex;
use Sven\TlsChecker\Tests\TestCase;

class CrawlDirectoryTest extends TestCase
{
    /** @test */
    public function it_finds_files_with_http_urls_in_them()
    {
        $path = $this->path(__DIR__.'/__stubs__/insecure_and_secure');

        $files = DirectoryCrawler::find(Regex::HTTP_URL)->in($path);

        $this->assertInternalType('array', $files);
        $this->assertCount(1, $files);
        $this->assertEquals(
            $this->path(__DIR__.'/__stubs__/insecure_and_secure/insecure.txt'),
            reset($files)->getPathname()
        );
    }

    /** @test */
    public function the_file_crawler_can_return_an_interator()
    {
        $files = DirectoryCrawler::find(Regex::HTTP_URL)->in(__DIR__, true);

        $this->assertInternalType('iterable', $files);
    }

    /** @test */
    public function all_found_files_have_insecure_urls_in_them()
    {
        $path = $this->path(__DIR__.'/__stubs__/insecure_and_secure');

        $files = DirectoryCrawler::find(Regex::HTTP_URL)->in($path);

        foreach ($files as $file) {
            $this->assertRegExp(Regex::HTTP_URL, $file->getContents());
        }
    }
}
