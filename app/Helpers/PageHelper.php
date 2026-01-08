<?php

namespace App\Helpers;

class PageHelper
{
    public static function labels(): array
    {
        $labels = [
            'landing' => 'Landing Page',
            'service' => 'Service Page',
            'rental'  => 'Rental Page',
            'blog'    => 'Blog Page',
            'repair'  => 'Repair Page',
            'location' => 'Location Page',
            'about-us' => 'About Us',
            'contact-us' => 'Contact Us',
            'offer'   => 'Offer Page',
        ];

        ksort($labels); // ASC
        return $labels;
    }
}
