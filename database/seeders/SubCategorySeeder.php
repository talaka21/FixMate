<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

  $subcategories = [
            // Healthcare
            [
                'category_id' => 1,
                'name' => ['en' => 'Hospitals', 'ar' => 'المستشفيات'],
                'description' => ['en' => 'Facilities providing inpatient and outpatient medical care.', 'ar' => 'منشآت تقدم الرعاية الطبية للمرضى الداخليين والخارجيين.'],
            ],
            [
                'category_id' => 1,
                'name' => ['en' => 'Clinics', 'ar' => 'العيادات'],
                'description' => ['en' => 'Centers offering outpatient medical services.', 'ar' => 'مراكز تقدم خدمات طبية للمرضى الخارجيين.'],
            ],
            [
                'category_id' => 1,
                'name' => ['en' => 'Pharmacies', 'ar' => 'الصيدليات'],
                'description' => ['en' => 'Places to purchase medicines and health products.', 'ar' => 'أماكن لشراء الأدوية والمنتجات الصحية.'],
            ],
            [
                'category_id' => 1,
                'name' => ['en' => 'Emergency Services', 'ar' => 'خدمات الطوارئ'],
                'description' => ['en' => 'Immediate medical assistance and ambulance services.', 'ar' => 'مساعدة طبية فورية وخدمات إسعاف.'],
            ],

            // Education
            [
                'category_id' => 2,
                'name' => ['en' => 'Schools', 'ar' => 'المدارس'],
                'description' => ['en' => 'Institutions for primary and secondary education.', 'ar' => 'مؤسسات للتعليم الأساسي والثانوي.'],
            ],
            [
                'category_id' => 2,
                'name' => ['en' => 'Universities', 'ar' => 'الجامعات'],
                'description' => ['en' => 'Higher education institutions offering degrees.', 'ar' => 'مؤسسات للتعليم العالي تقدم الشهادات الجامعية.'],
            ],
            [
                'category_id' => 2,
                'name' => ['en' => 'Vocational Training', 'ar' => 'التدريب المهني'],
                'description' => ['en' => 'Skill development and technical training programs.', 'ar' => 'برامج تطوير المهارات والتدريب التقني.'],
            ],

            // Transportation
            [
                'category_id' => 3,
                'name' => ['en' => 'Public Transport', 'ar' => 'النقل العام'],
                'description' => ['en' => 'Bus, metro, and other public transport services.', 'ar' => 'خدمات الحافلات والمترو ووسائل النقل العام الأخرى.'],
            ],
            [
                'category_id' => 3,
                'name' => ['en' => 'Vehicle Registration', 'ar' => 'تسجيل المركبات'],
                'description' => ['en' => 'Official registration of vehicles with authorities.', 'ar' => 'التسجيل الرسمي للمركبات لدى الجهات المختصة.'],
            ],
            [
                'category_id' => 3,
                'name' => ['en' => 'Driving Licenses', 'ar' => 'رخص القيادة'],
                'description' => ['en' => 'Issuance of driving licenses for individuals.', 'ar' => 'إصدار رخص القيادة للأفراد.'],
            ],

            // Finance
            [
                'category_id' => 4,
                'name' => ['en' => 'Banking', 'ar' => 'الخدمات المصرفية'],
                'description' => ['en' => 'Services related to bank accounts and transactions.', 'ar' => 'خدمات متعلقة بالحسابات المصرفية والمعاملات.'],
            ],
            [
                'category_id' => 4,
                'name' => ['en' => 'Taxes', 'ar' => 'الضرائب'],
                'description' => ['en' => 'Payment and management of taxes.', 'ar' => 'دفع وإدارة الضرائب.'],
            ],
            [
                'category_id' => 4,
                'name' => ['en' => 'Investments', 'ar' => 'الاستثمارات'],
                'description' => ['en' => 'Financial investments and asset management services.', 'ar' => 'الاستثمارات المالية وخدمات إدارة الأصول.'],
            ],

            // Legal
            [
                'category_id' => 5,
                'name' => ['en' => 'Court Services', 'ar' => 'خدمات المحاكم'],
                'description' => ['en' => 'Services provided by courts and legal institutions.', 'ar' => 'الخدمات المقدمة من المحاكم والمؤسسات القانونية.'],
            ],
            [
                'category_id' => 5,
                'name' => ['en' => 'Notary', 'ar' => 'التوثيق'],
                'description' => ['en' => 'Authentication and notarization of official documents.', 'ar' => 'توثيق وتصديق المستندات الرسمية.'],
            ],
            [
                'category_id' => 5,
                'name' => ['en' => 'Legal Aid', 'ar' => 'المساعدة القانونية'],
                'description' => ['en' => 'Support and legal consultation for citizens.', 'ar' => 'الدعم والاستشارات القانونية للمواطنين.'],
            ],

            // Housing
            [
                'category_id' => 6,
                'name' => ['en' => 'Real Estate', 'ar' => 'العقارات'],
                'description' => ['en' => 'Buying, selling, and renting properties.', 'ar' => 'شراء وبيع وتأجير العقارات.'],
            ],
            [
                'category_id' => 6,
                'name' => ['en' => 'Utilities', 'ar' => 'المرافق'],
                'description' => ['en' => 'Provision and payment of electricity, water, and gas.', 'ar' => 'توفير ودفع خدمات الكهرباء والمياه والغاز.'],
            ],
            [
                'category_id' => 6,
                'name' => ['en' => 'Building Permits', 'ar' => 'تصاريح البناء'],
                'description' => ['en' => 'Official permissions for construction and renovations.', 'ar' => 'تصاريح رسمية للبناء والتجديدات.'],
            ],

            // Business
            [
                'category_id' => 7,
                'name' => ['en' => 'Company Registration', 'ar' => 'تسجيل الشركات'],
                'description' => ['en' => 'Legal registration of new companies.', 'ar' => 'التسجيل القانوني للشركات الجديدة.'],
            ],
            [
                'category_id' => 7,
                'name' => ['en' => 'Licenses', 'ar' => 'التراخيص'],
                'description' => ['en' => 'Issuance of business and operational licenses.', 'ar' => 'إصدار التراخيص التجارية والتشغيلية.'],
            ],
            [
                'category_id' => 7,
                'name' => ['en' => 'Trade', 'ar' => 'التجارة'],
                'description' => ['en' => 'Commercial trading and business-related services.', 'ar' => 'التجارة والخدمات المتعلقة بالأعمال.'],
            ],
        ];

        // تحويل المصفوفات إلى JSON قبل الإدراج
        foreach ($subcategories as &$subcategory) {
            $subcategory['name'] = json_encode($subcategory['name'], JSON_UNESCAPED_UNICODE);
            $subcategory['description'] = json_encode($subcategory['description'], JSON_UNESCAPED_UNICODE);
        }

        DB::table('subcategories')->insert($subcategories);

    }
}



