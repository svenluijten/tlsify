<?php

namespace Sven\TlsChecker;

use Symfony\Component\Finder\Finder;

class DirectoryCrawler
{
    /**
     * @var string
     */
    protected $regex;

    private function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public static function find(string $regex): self
    {
        return new self($regex);
    }

    public function in(string $path, bool $asIterator = false)
    {
        $iterator = Finder::create()
            ->files()
            ->in($path)
            ->ignoreDotFiles(true)
            ->contains($this->regex);

        if ($asIterator) {
            return $iterator;
        }

        return iterator_to_array($iterator);
    }
}
