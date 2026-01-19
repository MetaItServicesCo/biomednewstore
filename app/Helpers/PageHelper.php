<?php

namespace App\Helpers;

class PageHelper
{
    public static function labels(): array
    {
        $labels = [
            'landing' => 'Landing Page',
            'products' => 'Products Page',
            'parts' => 'Parts Page',
        ];

        ksort($labels); // ASC
        return $labels;
    }
}
