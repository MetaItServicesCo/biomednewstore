<?php

use App\Models\Faq;
use App\Models\GeneralSetting;
use App\Models\State;
use Illuminate\Support\Facades\Cache;

if (!function_exists('theme')) {
    function theme()
    {
        return app(App\Core\Theme::class);
    }
}


if (!function_exists('getName')) {
    /**
     * Get product name
     *
     * @return void
     */
    function getName()
    {
        return config('settings.KT_THEME');
    }
}


if (!function_exists('addHtmlAttribute')) {
    /**
     * Add HTML attributes by scope
     *
     * @param $scope
     * @param $name
     * @param $value
     *
     * @return void
     */
    function addHtmlAttribute($scope, $name, $value)
    {
        theme()->addHtmlAttribute($scope, $name, $value);
    }
}


if (!function_exists('addHtmlAttributes')) {
    /**
     * Add multiple HTML attributes by scope
     *
     * @param $scope
     * @param $attributes
     *
     * @return void
     */
    function addHtmlAttributes($scope, $attributes)
    {
        theme()->addHtmlAttributes($scope, $attributes);
    }
}


if (!function_exists('addHtmlClass')) {
    /**
     * Add HTML class by scope
     *
     * @param $scope
     * @param $value
     *
     * @return void
     */
    function addHtmlClass($scope, $value)
    {
        theme()->addHtmlClass($scope, $value);
    }
}


if (!function_exists('printHtmlAttributes')) {
    /**
     * Print HTML attributes for the HTML template
     *
     * @param $scope
     *
     * @return string
     */
    function printHtmlAttributes($scope)
    {
        return theme()->printHtmlAttributes($scope);
    }
}


if (!function_exists('printHtmlClasses')) {
    /**
     * Print HTML classes for the HTML template
     *
     * @param $scope
     * @param $full
     *
     * @return string
     */
    function printHtmlClasses($scope, $full = true)
    {
        return theme()->printHtmlClasses($scope, $full);
    }
}


if (!function_exists('getSvgIcon')) {
    /**
     * Get SVG icon content
     *
     * @param $path
     * @param $classNames
     * @param $folder
     *
     * @return string
     */
    function getSvgIcon($path, $classNames = 'svg-icon', $folder = 'assets/media/icons/')
    {
        return theme()->getSvgIcon($path, $classNames, $folder);
    }
}


if (!function_exists('setModeSwitch')) {
    /**
     * Set dark mode enabled status
     *
     * @param $flag
     *
     * @return void
     */
    function setModeSwitch($flag)
    {
        theme()->setModeSwitch($flag);
    }
}


if (!function_exists('isModeSwitchEnabled')) {
    /**
     * Check dark mode status
     *
     * @return void
     */
    function isModeSwitchEnabled()
    {
        return theme()->isModeSwitchEnabled();
    }
}


if (!function_exists('setModeDefault')) {
    /**
     * Set the mode to dark or light
     *
     * @param $mode
     *
     * @return void
     */
    function setModeDefault($mode)
    {
        theme()->setModeDefault($mode);
    }
}


if (!function_exists('getModeDefault')) {
    /**
     * Get current mode
     *
     * @return void
     */
    function getModeDefault()
    {
        return theme()->getModeDefault();
    }
}


if (!function_exists('setDirection')) {
    /**
     * Set style direction
     *
     * @param $direction
     *
     * @return void
     */
    function setDirection($direction)
    {
        theme()->setDirection($direction);
    }
}


if (!function_exists('getDirection')) {
    /**
     * Get style direction
     *
     * @return void
     */
    function getDirection()
    {
        return theme()->getDirection();
    }
}


if (!function_exists('isRtlDirection')) {
    /**
     * Check if style direction is RTL
     *
     * @return void
     */
    function isRtlDirection()
    {
        return theme()->isRtlDirection();
    }
}


if (!function_exists('extendCssFilename')) {
    /**
     * Extend CSS file name with RTL or dark mode
     *
     * @param $path
     *
     * @return void
     */
    function extendCssFilename($path)
    {
        return theme()->extendCssFilename($path);
    }
}


if (!function_exists('includeFavicon')) {
    /**
     * Include favicon from settings
     *
     * @return string
     */
    function includeFavicon()
    {
        return theme()->includeFavicon();
    }
}


if (!function_exists('includeFonts')) {
    /**
     * Include the fonts from settings
     *
     * @return string
     */
    function includeFonts()
    {
        return theme()->includeFonts();
    }
}


if (!function_exists('getGlobalAssets')) {
    /**
     * Get the global assets
     *
     * @param $type
     *
     * @return array
     */
    function getGlobalAssets($type = 'js')
    {
        return theme()->getGlobalAssets($type);
    }
}


if (!function_exists('addVendors')) {
    /**
     * Add multiple vendors to the page by name. Refer to settings KT_THEME_VENDORS
     *
     * @param $vendors
     *
     * @return void
     */
    function addVendors($vendors)
    {
        theme()->addVendors($vendors);
    }
}


if (!function_exists('addVendor')) {
    /**
     * Add single vendor to the page by name. Refer to settings KT_THEME_VENDORS
     *
     * @param $vendor
     *
     * @return void
     */
    function addVendor($vendor)
    {
        theme()->addVendor($vendor);
    }
}


if (!function_exists('addJavascriptFile')) {
    /**
     * Add custom javascript file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addJavascriptFile($file)
    {
        theme()->addJavascriptFile($file);
    }
}


if (!function_exists('addCssFile')) {
    /**
     * Add custom CSS file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addCssFile($file)
    {
        theme()->addCssFile($file);
    }
}


if (!function_exists('getVendors')) {
    /**
     * Get vendor files from settings. Refer to settings KT_THEME_VENDORS
     *
     * @param $type
     *
     * @return array
     */
    function getVendors($type)
    {
        return theme()->getVendors($type);
    }
}


if (!function_exists('getCustomJs')) {
    /**
     * Get custom js files from the settings
     *
     * @return array
     */
    function getCustomJs()
    {
        return theme()->getCustomJs();
    }
}


if (!function_exists('getCustomCss')) {
    /**
     * Get custom css files from the settings
     *
     * @return array
     */
    function getCustomCss()
    {
        return theme()->getCustomCss();
    }
}


if (!function_exists('getHtmlAttribute')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $scope
     * @param $attribute
     *
     * @return array
     */
    function getHtmlAttribute($scope, $attribute)
    {
        return theme()->getHtmlAttribute($scope, $attribute);
    }
}


if (!function_exists('isUrl')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $url
     *
     * @return mixed
     */
    function isUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}


if (!function_exists('image')) {
    /**
     * Get image url by path
     *
     * @param $path
     *
     * @return string
     */
    function image($path)
    {
        return asset('assets/media/' . $path);
    }
}


if (!function_exists('getIcon')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function getIcon($name, $class = '', $type = '', $tag = 'span')
    {
        return theme()->getIcon($name, $class, $type, $tag);
    }
}

if (!function_exists('split_heading')) {
    /**
     * Split heading into two parts based on [bracketed] text
     *
     * Example:
     *  Input:  "Boost Your Success With [Our Expertise]"
     *  Output: ['first_text' => 'Boost Your Success With', 'second_text' => 'Our Expertise']
     */
    function split_heading($text)
    {

        // Handle null or non-string inputs safely
        if (empty($text) || !is_string($text)) {
            return [
                'first_text'  => '',
                'second_text' => '',
            ];
        }


        $pattern = '/(.*?)\[(.*?)\]/';

        if (preg_match($pattern, $text, $matches)) {
            return [
                'first_text'  => trim($matches[1]),
                'second_text' => trim($matches[2]),
            ];
        }

        // fallback — if no brackets found
        return [
            'first_text'  => $text,
            'second_text' => '',
        ];
    }
}


if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return GeneralSetting::where('is_active', true)
                ->pluck('value', 'key')
                ->toArray();
        });

        return $settings[$key] ?? $default;
    }
}


if (!function_exists('cleanPhone')) {
    function cleanPhone($number)
    {
        if (!$number) return '';
        // Remove everything except digits and +
        return preg_replace('/[^0-9+]/', '', $number);
    }
}

if (!function_exists('highlightBracketText')) {

    /**
     * Highlight each [text] using different colors.
     *
     * @param string $text
     * @param array $colors
     * @return string
     */
    function highlightBracketText($text, $colors = ['#0168a4'])
    {
        if (!$text) return '';

        // Escape full text first
        $escaped = e($text);

        // Color index
        $i = 0;

        return preg_replace_callback('/\[(.*?)\]/', function ($match) use (&$i, $colors) {

            // If colors array ends, repeat last color
            $color = $colors[$i] ?? end($colors);

            $i++;

            return "<span style=\"color: {$color};\">{$match[1]}</span>";
        }, $escaped);
    }
}

if (!function_exists('plainBracketText')) {

    /**
     * Convert [text] into plain text by removing brackets and keeping the content inside.
     * Also trims extra spaces.
     *
     * @param string $text
     * @return string
     */
    function plainBracketText($text)
    {
        if (!$text) return '';

        // Remove brackets but keep the content inside
        $plain = preg_replace('/\[(.*?)\]/', '$1', $text);

        // Replace multiple spaces with single space and trim
        $plain = preg_replace('/\s+/', ' ', $plain);

        return trim($plain);
    }
}



if (!function_exists('merge_images')) {

    /**
     * Merge thumbnail + gallery images into a single array (with paths).
     *
     * @param  \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model  $items
     * @param  string  $thumbnailColumn
     * @param  string  $galleryColumn
     * @param  string  $finalKey
     * @param  string  $thumbnailPath
     * @param  string  $galleryPath
     * @return mixed
     */
    function merge_images($items, $thumbnailColumn, $galleryColumn, $finalKey = 'all_images', $thumbnailPath = '', $galleryPath = '')
    {
        /**
         * SMALL INTERNAL FUNCTION TO BUILD IMAGE PATHS
         */
        $buildPath = function ($path, $filename) {
            return rtrim($path, '/') . '/' . ltrim($filename, '/');
        };

        /**
         * CASE 1 — SINGLE MODEL INSTANCE
         */
        if ($items instanceof \Illuminate\Database\Eloquent\Model) {

            $images = [];

            // Add thumbnail + path
            if (!empty($items->{$thumbnailColumn})) {
                $images[] = $buildPath($thumbnailPath, $items->{$thumbnailColumn});
            }

            // Decode gallery JSON
            $gallery = $items->{$galleryColumn};
            $decoded = json_decode($gallery, true);

            if (is_array($decoded)) {
                foreach ($decoded as $img) {
                    $images[] = $buildPath($galleryPath, $img);
                }
            }

            $items->{$finalKey} = $images;
            return $items;
        }

        /**
         * CASE 2 — PAGINATOR / COLLECTION
         */
        $items->getCollection()->transform(function ($item) use ($thumbnailColumn, $galleryColumn, $finalKey, $thumbnailPath, $galleryPath, $buildPath) {

            $images = [];

            if (!empty($item->{$thumbnailColumn})) {
                $images[] = $buildPath($thumbnailPath, $item->{$thumbnailColumn});
            }

            $gallery = $item->{$galleryColumn};
            $decoded = json_decode($gallery, true);

            if (is_array($decoded)) {
                foreach ($decoded as $img) {
                    $images[] = $buildPath($galleryPath, $img);
                }
            }

            $item->{$finalKey} = $images;

            return $item;
        });

        return $items;
    }
}



if (!function_exists('getFaqs')) {

    /**
     * Get FAQs by page name
     *
     * @param  string  $pageName
     * @param  int     $limit
     * @return \Illuminate\Support\Collection
     */
    function getFaqs($pageName)
    {
        return Faq::where('page_name', $pageName)
            ->select(['question', 'answer'])
            ->latest()
            // ->take($limit)
            ->get();
    }
}


if (! function_exists('city_labels')) {
    function city_labels(): array
    {
        return [
            'dallas'       => 'Dallas TX',
            'garland'      => 'Garland TX',
            'houston'      => 'Houston TX',
            'austin'       => 'Austin TX',
            'san-antonio'  => 'San-Antonio TX',
        ];
    }
}

if (! function_exists('city_label')) {
    function city_label(?string $key): string
    {
        return city_labels()[$key] ?? ucfirst(str_replace('-', ' ', (string) $key));
    }
}

if (!function_exists('getServicesList')) {
    /**
     * Get the list of services in ascending order
     *
     * @return array
     */
    function getServicesList(): array
    {
        $services = [
            'Biomedical Equipment Inspection',
            'Calibration Services',
            'Disposition & Asset Management',
            'Medical Equipment Repair & Maintenance',
            'Medical Equipment Rental',
            'New & Pre-Owned Medical Equipment Sales',
            'Preventive Maintenance (PM Services)',
            'Refurbishing Services',
            'Service Contracts (AMC / CMC)',
        ];

        sort($services); // Sort alphabetically ascending

        return $services;
    }
}


if (!function_exists('getConsultancyServicesList')) {
    /**
     * Get the list of consultancy/service options in alphabetical order
     * with "Other Inquiry" always at the end
     *
     * @return array
     */
    function getConsultancyServicesList(): array
    {
        $services = [
            'Equipment Inspection',
            'Repair & Maintenance',
            'Calibration',
            'Preventive Maintenance',
            'Refurbishing',
            'Equipment Sales',
            'Equipment Rental',
            'Service Contracts',
            'MedRad Support',
            'Free Consultation',
            'Other Inquiry',
        ];

        // Remove "Other Inquiry" temporarily
        $other = array_pop($services);

        // Sort remaining services alphabetically
        sort($services);

        // Add "Other Inquiry" at the end
        $services[] = $other;

        return $services;
    }
}


if (!function_exists('getPriorityCountries')) {
    function getPriorityCountries()
    {
        return [
            ['id' => 39,  'name' => 'Canada'],
            ['id' => 232, 'name' => 'United Kingdom'],
            ['id' => 233, 'name' => 'United States'],
            ['id' => 14,  'name' => 'Australia'],
        ];
    }
}

if (!function_exists('getPriorityStates')) {
    function getPriorityStates()
    {
        $priorityCountries = getPriorityCountries();
        $countryIds = collect($priorityCountries)->pluck('id')->toArray();

        return \Illuminate\Support\Facades\Cache::rememberForever('footer_priority_states', function () use ($countryIds) {
            return State::query()
                ->whereIn('country_id', $countryIds)
                ->where('is_active', 1)
                ->orderBy('name')
                ->get(['id', 'name', 'country_id']);
        });
    }
}
