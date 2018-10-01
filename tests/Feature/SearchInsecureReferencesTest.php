<?php

namespace Sven\Tlsify\Tests\Feature;

use Sven\Tlsify\Tests\TestCase;
use Sven\Tlsify\Tlsify;
use Symfony\Component\Finder\Finder;

class SearchInsecureReferencesTest extends TestCase
{
    /** @test */
    public function it_finds_files_with_http_urls_in_them()
    {
        $finder = Finder::create()->in($this->path(__DIR__.'/__stubs__/insecure_and_secure'));

        /** @var array|\Symfony\Component\Finder\SplFileInfo[] $urls */
        $urls = Tlsify::make($finder)->insecureUrls();

        $this->assertInternalType('array', $urls);
        $this->assertCount(1, $urls);
        $this->assertEquals($this->path(__DIR__.'/__stubs__/insecure_and_secure/insecure.txt'), reset($urls)->getPathname());
    }

    /** @test */
    public function it_can_return_an_iterator()
    {
        $finder = Finder::create()->in($this->path(__DIR__.'/__stubs__/insecure_and_secure'));

        $this->assertInternalType('iterable', Tlsify::make($finder)->insecureUrls(true));
    }
}
