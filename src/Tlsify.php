<?php

namespace Sven\Tlsify;

use Symfony\Component\Finder\Finder;

class Tlsify
{
    protected const HTTP_URL_REGEX = '/^http:\/\/([^\s:]+)(?::(\d+))?/im';

    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    private function __construct(Finder $finder)
    {
        $this->finder = $finder->files()->ignoreDotFiles(true);
    }

    public static function make(Finder $finder): self
    {
        return new self($finder);
    }

    /**
     * @param bool $asIterator
     *
     * @return array|iterable
     */
    public function insecureUrls(bool $asIterator = false)
    {
        $iterator = $this->finder->contains(self::HTTP_URL_REGEX);

        if ($asIterator) {
            return $iterator;
        }

        return iterator_to_array($iterator);
    }
}
