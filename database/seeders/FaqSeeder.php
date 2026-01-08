<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
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
                    'question' => 'What types of medical equipment do you service?',
                    'answer'   => 'We service a range of biomed equipment in the Texas area, including: anesthesia machines, general surgical and medical equipment, laboratory equipment, imaging and diagnostic tools, rehabilitation and pain management equipment, respiratory equipment, and sterilizers.',
                ],
                [
                    'question' => 'Do you offer 24/7 medical equipment repair services?',
                    'answer'   => 'Yes, we are known for our reliability and around-the-clock solutions for selling new and refurbished medical equipment and reliable disposition services.',
                ],
                [
                    'question' => 'What is the closest medical equipment rental near me?',
                    'answer'   => 'The closest medical equipment rental services are located in the heart of Texas-- Mr Biomed Tech. They provide a variety of biomed tech makes and models for the Austin, San Antonio, Dallas, and Houston areas.',
                ],
                [
                    'question' => 'Which areas does Mr Biomed Tech serve in Texas?',
                    'answer'   => 'Mr Biomed Tech offers fast diagnostics and repair for critical care equipment with transparent pricing in the Austin, San Antonio, Dallas, and Houston areas of Texas.',
                ],
                [
                    'question' => 'How do I know which biomed equipment is right for my hospital?',
                    'answer'   => 'The BMEs (biomedical engineering) and experts at Mr Biomed Tech can help assess patient needs and long-term scaling plans in order to provide you with the best biomed equipment options for your hospital.',
                ],
                [
                    'question' => 'What types of imaging devices do biomedical engineers repair?',
                    'answer'   => 'Biomedical equipment technicians repair a wide array of imaging devices from computer tomography (CT) scans to X-ray machines. Mr Biomed Tech specializes in repairing C-arms in the Austin, Texas area.',
                ],
                [
                    'question' => 'Can you help with the disposition of medical equipment?',
                    'answer'   => 'Yes, we can help discard obsolete medical waste, tech equipment, or restore capital if you wish to sell your machinery.',
                ],
                [
                    'question' => 'What is the MedRad Smart System?',
                    'answer'   => 'The MedRad Smart System is an asset management software based on the cloud. It is used to manage the span of medical equipment in order to assist healthcare facilities maintenance schedules.',
                ],
                [
                    'question' => 'Do biomedical medical technicians support outpatient centers?',
                    'answer'   => 'Mr-Biomed’s technicians assist outpatient centers by calibrating and troubleshooting faster and more precisely than on-site BMEs.',
                ],
                [
                    'question' => 'What are the best medical equipment companies in Dallas, TX?',
                    'answer'   => 'Mr Biomed Tech Services offers the best medical equipment in Dallas, TX, ranging from infusion pumps, ventilators, and imaging systems to large-scale machinery.',
                ],
            ],

            'location' => [
                // add later
            ],

            'service' => [
                [
                    'question' => 'How does renting medical equipment in Texas benefit my healthcare facility?',
                    'answer'   => 'Renting surgical and medical equipment with Mr Biomed Tech in Texas gets you in touch with industry-leading manufacturers and biomedical equipment specialists who have experience in handling all kinds of surgical and medical machinery.',
                ],
                [
                    'question' => 'Can I test the rental medical equipment in Texas before committing to a purchase?',
                    'answer'   => 'Mr Biomed Tech’s try-before-you-buy policy gives healthcare facilities a fair shot at seeing what machinery is best suited for their patients’ needs.',
                ],
                [
                    'question' => 'How do I find the best medical equipment rental companies in Texas?',
                    'answer'   => 'The best biomedical equipment rental company is Mr Biomed Tech who services areas all across Texas, including Garland, San Antonio, Austin, Dallas, and Houston.',
                ],
                [
                    'question' => 'Do you offer used medical equipment rental near me?',
                    'answer'   => 'Used biomedical equipment rental is available at Mr Biomed Tech in Texas. We offer a variety of biomed equipment selections from renowned manufacturers. All our products are refurbished for ready-to-use working conditions.',
                ],
                [
                    'question' => 'What does a biomedical equipment technician do?',
                    'answer'   => 'A biomedical equipment technician has the interdisciplinary knowledge to calibrate, repair, and maintain a wide variety of surgical and medical technology for hospitals and other healthcare facilities.',
                ],
                [
                    'question' => 'How fast can Mr Biomed Tech repair biomedical equipment?',
                    'answer'   => 'Mr Biomed Tech offers 24/7 biomedical equipment repair services all over Texas in case of any healthcare emergencies.',
                ],
                [
                    'question' => 'Can biomedical technicians train hospital staff?',
                    'answer'   => 'The biomedical technicians at Mr Biomed Tech Services offer training to hospital staff to prevent misuse of machinery and so clinicians can identify regulatory issues.',
                ],
                [
                    'question' => 'What types of equipment does Mr Biomed Tech sell?',
                    'answer'   => 'Mr Biomed Tech sells equipment ranging from hospital beds and stretchers to autoclave machines and other sterilization devices, as well as defibrillators, SCD pumps, X-rays, etc.',
                ],
                [
                    'question' => 'How do you sterilize surgical equipment properly?',
                    'answer'   => 'To sterilize surgical equipment requires a methodical decontamination process to avoid pathogenic transfer. You can rent or purchase a sterilization device, such as an autoclave, from Mr Biomed Tech Services in Texas.',
                ],
                [
                    'question' => 'How does a medical equipment management strategy reduce costs for hospitals?',
                    'answer'   => 'A medical equipment management strategy is employed by Mr Biomed Tech to assist hospitals in keeping track of preventative maintenance of machinery, spare parts inventory, and staying up to date on device lifecycles. It ultimately ensures the investment in your medical equipment.',
                ],
            ],

        ];

        foreach ($faqsByPage as $pageName => $faqs) {
            foreach ($faqs as $faq) {
                Faq::updateOrCreate(
                    [
                        'page_name' => $pageName,
                        'question'  => $faq['question'],
                    ],
                    [
                        'answer' => $faq['answer'],
                    ]
                );
            }
        }
    }
}
