<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //Step 2: Truncate table
        Faq::truncate();

        // Step 3: Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faqsByPage = [

            'landing' => [
                [
                    'question' => 'What products do you sell?',
                    'answer' => 'We provide a wide range of medical equipment, biomedical accessories, supplies, and replacement parts for hospitals, clinics, labs, and home-care setups. If you can’t find something online, you can request it and we’ll help source it.',
                ],
                [
                    'question' => 'Do you help customers choose the right equipment or part?',
                    'answer' => 'Yes. If you’re not sure which item fits your needs, share your device model, part number, or requirement, and our team will guide you to the best option—without confusing technical jargon.',
                ],
                [
                    'question' => 'Are your parts genuine (OEM) or compatible replacements?',
                    'answer' => 'We offer OEM/genuine parts and trusted compatible replacements depending on availability. Product pages (or quotes) include compatibility details so you can order with confidence.',
                ],
                [
                    'question' => 'What biomedical services do you offer?',
                    'answer' => 'We support equipment with services such as installation, calibration, preventive maintenance (PM), troubleshooting, and repair. Service availability may depend on your location and equipment type.',
                ],
                [
                    'question' => 'Do you provide on-site service?',
                    'answer' => 'On-site service may be available in selected areas. Contact us with your location and device details, and we’ll confirm coverage and scheduling.',
                ],
                [
                    'question' => 'How do I check compatibility before ordering a part?',
                    'answer' => 'The fastest way is to search by part number. If you don’t have it, send us the device name + model, or a photo of the label, and we’ll help verify compatibility before you buy.',
                ],
                [
                    'question' => 'How long does shipping take?',
                    'answer' => 'Shipping time depends on the item and destination. In-stock items generally ship quickly. If an item requires special handling or confirmation, our team will contact you with the best shipping option.',
                ],
                [
                    'question' => 'Do you offer store pickup?',
                    'answer' => 'If store pickup is available, you can choose Pick Up From Store at checkout. We’ll notify you when your order is ready for pickup.',
                ],
                [
                    'question' => 'Can I request a quote for bulk orders or high-value items?',
                    'answer' => 'Absolutely. Use the Request a Quote option for bulk purchases, multiple items, or special requirements. We’ll respond with pricing, availability, and delivery options.',
                ],
                [
                    'question' => 'Do you offer warranties?',
                    'answer' => 'Many items have warranty options (depending on product type and condition). Warranty details are shown on the product page or included in your quote/invoice.',
                ],
                [
                    'question' => 'What if I can’t find my product or part on the website?',
                    'answer' => 'No problem. Click Request Custom Parts (or contact us) and share your device model/part number. We’ll try to source the exact part or recommend a compatible alternative.',
                ],
                [
                    'question' => 'How can I contact support?',
                    'answer' => 'You can reach us via phone, email, or the quick chat form on the website. Share your requirements and we’ll respond as soon as possible.',
                ],
            ],
            'parts' => [
                [
                    'question' => 'How do I make sure a part is compatible with my device?',
                    'answer' => 'The best way is to search using your device model or part number. If you’re unsure, send us a photo of the label or serial/model info—we’ll help confirm compatibility.',
                ],
                [
                    'question' => 'Do you sell genuine (OEM) parts?',
                    'answer' => 'We offer genuine/OEM and trusted compatible replacements depending on availability. Each listing clearly indicates compatibility and condition.',
                ],
                [
                    'question' => 'What if I can’t find my part on the website?',
                    'answer' => 'Use the Request Custom Parts button. Share your device model and required part—we’ll source it or suggest an alternative.',
                ],
                [
                    'question' => 'Do parts come with warranty?',
                    'answer' => 'Many parts include warranty options. Warranty details (if available) are shown on the product page or provided with your quote.',
                ],
                [
                    'question' => 'How fast do you ship?',
                    'answer' => 'Shipping time depends on stock status and location. In-stock parts typically ship quickly. If you need urgent delivery, contact support and we’ll check the fastest option.',
                ],
                [
                    'question' => 'Can you help with installation or troubleshooting?',
                    'answer' => 'Yes. Our team can guide you with basic checks and can also schedule service, calibration, or repair if needed.',
                ],
            ],

            'products' => [
                [
                    'question' => 'What types of biomedical parts and equipment do you offer?',
                    'answer' => 'We stock a wide range of biomedical parts, equipment, and accessories for medical facilities, including refurbished and new components.',
                ],
                [
                    'question' => 'Do you provide warranties on parts and equipment?',
                    'answer' => 'Yes! All our biomedical parts and equipment come with a parts warranty to ensure quality and peace of mind.',
                ],
                [
                    'question' => 'Can I get medical equipment repaired or maintained by you?',
                    'answer' => 'Absolutely — we offer professional maintenance and repair services for a variety of biomedical devices.',
                ],
                [
                    'question' => 'Do you offer custom parts or specialized solutions?',
                    'answer' => 'Yes. We can help source or custom‑design parts based on your specific biomedical needs. Contact us for details.',
                ],
                [
                    'question' => 'How long does delivery take after I place an order?',
                    'answer' => 'Delivery timelines depend on the item and your location — most in‑stock parts ship quickly, and we’ll provide tracking once your order is processed.',
                ],
                [
                    'question' => 'Can I request a quote before buying?',
                    'answer' => 'Yes. Simply fill out our Get A Quote form or contact us for a detailed quote before placing your order.',
                ],
                [
                    'question' => 'What payment methods do you accept?',
                    'answer' => 'We accept secure online payments via card, and can also arrange invoice billing for qualifying institutional customers.',
                ],
                [
                    'question' => 'Where are you located and how can I contact you?',
                    'answer' => 'Visit us at 555 N. 5th Street Suite 109B, Garland, TX 75040 or call +1 (469) 767‑8853. You can also email Service@mbmts.com for support.',
                ],
                [
                    'question' => 'Do you support rental or leasing of biomedical equipment?',
                    'answer' => 'Yes — flexible rental and leasing options are available for selected biomedical equipment. Contact us for terms.',
                ],
                [
                    'question' => 'What if I need help selecting the right part or equipment?',
                    'answer' => 'Our expert team is here to help you choose the right solution — just contact us and we’ll assist you based on your facility’s needs.',
                ],
            ],

        ];

        foreach ($faqsByPage as $pageName => $faqs) {
            foreach ($faqs as $faq) {
                Faq::updateOrCreate(
                    [
                        'page_name' => $pageName,
                        'question' => $faq['question'],
                    ],
                    [
                        'answer' => $faq['answer'],
                    ]
                );
            }
        }
    }
}
