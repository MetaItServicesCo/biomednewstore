<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaults = [
            // General
            ['key' => 'site_name',        'value' => 'Mr. Biomed Tech Services', 'type' => 'string',   'group' => 'general', 'order' => 1],
            ['key' => 'site_logo',        'value' => 'uploads/logo.png',          'type' => 'image',    'group' => 'general', 'order' => 2],
            ['key' => 'favicon',          'value' => 'uploads/favicon.ico',       'type' => 'image',    'group' => 'general', 'order' => 3],
            ['key' => 'footer_copyright', 'value' => 'Copyright © 2025 Mr Biomed Tech Services', 'type' => 'textarea', 'group' => 'general', 'order' => 10],

            // Contact
            ['key' => 'phone',            'value' => '+1 123 456 7890',           'type' => 'string',   'group' => 'contact', 'order' => 1],
            ['key' => 'email',            'value' => 'info@mrbioservices.com',    'type' => 'string',   'group' => 'contact', 'order' => 2],
            ['key' => 'whatsapp',         'value' => '+1234567890',               'type' => 'string',   'group' => 'contact', 'order' => 3],
            ['key' => 'address',          'value' => 'USA',                       'type' => 'text',     'group' => 'contact', 'order' => 4],

            // Social
            ['key' => 'facebook',         'value' => '', 'type' => 'string', 'group' => 'social', 'order' => 1],
            ['key' => 'instagram',        'value' => '', 'type' => 'string', 'group' => 'social', 'order' => 2],
            ['key' => 'twitter',          'value' => '', 'type' => 'string', 'group' => 'social', 'order' => 3],
            ['key' => 'linkedin',         'value' => '', 'type' => 'string', 'group' => 'social', 'order' => 4],

            // SMTP
            ['key' => 'smtp_host',        'value' => '',        'type' => 'string',   'group' => 'smtp', 'order' => 1],
            ['key' => 'smtp_port',        'value' => '587',     'type' => 'string',   'group' => 'smtp', 'order' => 2],
            ['key' => 'smtp_username',    'value' => '',        'type' => 'string',   'group' => 'smtp', 'order' => 3],
            ['key' => 'smtp_password',    'value' => '',        'type' => 'password', 'group' => 'smtp', 'order' => 4],
            ['key' => 'smtp_encryption',  'value' => 'tls',     'type' => 'string',   'group' => 'smtp', 'order' => 5],
            ['key' => 'smtp_from_email',  'value' => '',        'type' => 'string',   'group' => 'smtp', 'order' => 6],
            ['key' => 'smtp_from_name',   'value' => 'Mr. Biomed Tech Services', 'type' => 'string', 'group' => 'smtp', 'order' => 7],
        ];

        foreach ($defaults as $setting) {
            GeneralSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
