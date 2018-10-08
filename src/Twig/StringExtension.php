<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Class FilterExtension
 * @package App\Twig
 */
class StringExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('firstUpper', [$this, 'firstUpper']),
        ];
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('firstUpper', [$this, 'firstUpper']),
        ];
    }

    /**
     * @param string $value
     * @return string
     */
    public function firstUpper(string $value): string
    {
        $firstUpper = mb_strtoupper(mb_substr($value, 0, 1, 'UTF-8'));

        return $firstUpper . mb_substr($value, 1, mb_strlen($value), 'UTF-8');
    }
}
