<?php

namespace Database\Seeders;

use App\Models\GovernmentEntity;
use Illuminate\Database\Seeder;
use App\Enum\stateStatusEnum;
use Illuminate\Support\Facades\DB;

class GovernmentEntitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$government_entities = [
    [
        'name' => [
            'en' => 'Ministry of Interior',
            'ar' => 'وزارة الداخلية',
        ],
        'description' => [
            'en' => 'Responsible for internal security, police, and civil affairs.',
            'ar' => 'مسؤولة عن الأمن الداخلي والشرطة والشؤون المدنية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Defence',
            'ar' => 'وزارة الدفاع',
        ],
        'description' => [
            'en' => 'Oversees the armed forces and national defense.',
            'ar' => 'تشرف على القوات المسلحة والدفاع الوطني.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Foreign Affairs and Expatriates',
            'ar' => 'وزارة الخارجية والمغتربين',
        ],
        'description' => [
            'en' => 'Handles international relations and citizen services abroad.',
            'ar' => 'تعنى بالعلاقات الدولية وخدمات المواطنين في الخارج.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Justice',
            'ar' => 'وزارة العدل',
        ],
        'description' => [
            'en' => 'Manages courts, legal affairs, and law enforcement.',
            'ar' => 'تشرف على المحاكم والشؤون القانونية وإنفاذ القانون.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Awqaf',
            'ar' => 'وزارة الأوقاف',
        ],
        'description' => [
            'en' => 'Responsible for religious endowments and mosques.',
            'ar' => 'مسؤولة عن الأوقاف الدينية والمساجد.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Higher Education',
            'ar' => 'وزارة التعليم العالي',
        ],
        'description' => [
            'en' => 'Oversees universities and higher education institutions.',
            'ar' => 'تشرف على الجامعات ومؤسسات التعليم العالي.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Social and Labour Affairs',
            'ar' => 'وزارة الشؤون الاجتماعية والعمل',
        ],
        'description' => [
            'en' => 'Manages social services, labor regulations, and employment policies.',
            'ar' => 'تدير الخدمات الاجتماعية وتنظيمات العمل وسياسات التوظيف.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Finance',
            'ar' => 'وزارة المالية',
        ],
        'description' => [
            'en' => 'Responsible for the national budget, taxation, and public finances.',
            'ar' => 'مسؤولة عن الموازنة العامة والضرائب والمالية العامة.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Economy and Foreign Trade',
            'ar' => 'وزارة الاقتصاد والتجارة الخارجية',
        ],
        'description' => [
            'en' => 'Oversees economic policies and international trade.',
            'ar' => 'تشرف على السياسات الاقتصادية والتجارة الدولية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Health',
            'ar' => 'وزارة الصحة',
        ],
        'description' => [
            'en' => 'Manages public health, hospitals, and medical services.',
            'ar' => 'تشرف على الصحة العامة والمستشفيات والخدمات الطبية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Local Administration and Environment',
            'ar' => 'وزارة الإدارة المحلية والبيئة',
        ],
        'description' => [
            'en' => 'Responsible for local governance and environmental protection.',
            'ar' => 'مسؤولة عن الإدارة المحلية وحماية البيئة.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Communications and Information Technology',
            'ar' => 'وزارة الاتصالات وتكنولوجيا المعلومات',
        ],
        'description' => [
            'en' => 'Oversees telecommunications, IT, and digital transformation.',
            'ar' => 'تشرف على الاتصالات وتقنية المعلومات والتحول الرقمي.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Agriculture and Agrarian Reform',
            'ar' => 'وزارة الزراعة والإصلاح الزراعي',
        ],
        'description' => [
            'en' => 'Responsible for agriculture, land reform, and rural development.',
            'ar' => 'مسؤولة عن الزراعة والإصلاح الزراعي والتنمية الريفية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Education',
            'ar' => 'وزارة التربية',
        ],
        'description' => [
            'en' => 'Oversees primary and secondary education.',
            'ar' => 'تشرف على التعليم الأساسي والثانوي.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Public Works and Housing',
            'ar' => 'وزارة الأشغال العامة والإسكان',
        ],
        'description' => [
            'en' => 'Responsible for public infrastructure, roads, and housing projects.',
            'ar' => 'مسؤولة عن البنية التحتية العامة والطرق ومشاريع الإسكان.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Interior and Municipalities',
            'ar' => 'وزارة الداخلية والبلديات',
        ],
        'description' => [
            'en' => 'Manages municipal affairs and local administration.',
            'ar' => 'تشرف على شؤون البلديات والإدارة المحلية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Education and Higher Education',
            'ar' => 'وزارة التربية والتعليم العالي',
        ],
        'description' => [
            'en' => 'Responsible for overall education policy from primary to higher education.',
            'ar' => 'مسؤولة عن السياسات التعليمية من المرحلة الأساسية حتى التعليم العالي.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Public Health',
            'ar' => 'وزارة الصحة العامة',
        ],
        'description' => [
            'en' => 'Focuses on public health initiatives and preventive care.',
            'ar' => 'تركز على مبادرات الصحة العامة والرعاية الوقائية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Economy and Trade',
            'ar' => 'وزارة الاقتصاد والتجارة',
        ],
        'description' => [
            'en' => 'Develops economic strategies and trade regulations.',
            'ar' => 'تضع استراتيجيات اقتصادية وتنظيمات تجارية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Energy and Water',
            'ar' => 'وزارة الطاقة والمياه',
        ],
        'description' => [
            'en' => 'Oversees energy production and water resources management.',
            'ar' => 'تشرف على إنتاج الطاقة وإدارة الموارد المائية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Environment',
            'ar' => 'وزارة البيئة',
        ],
        'description' => [
            'en' => 'Responsible for environmental protection and sustainability.',
            'ar' => 'مسؤولة عن حماية البيئة والاستدامة.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Agriculture',
            'ar' => 'وزارة الزراعة',
        ],
        'description' => [
            'en' => 'Manages farming, livestock, and agricultural policy.',
            'ar' => 'تشرف على الزراعة وتربية المواشي والسياسات الزراعية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Industry',
            'ar' => 'وزارة الصناعة',
        ],
        'description' => [
            'en' => 'Oversees industrial development and manufacturing sectors.',
            'ar' => 'تشرف على التنمية الصناعية وقطاعات التصنيع.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Public Works and Transport',
            'ar' => 'وزارة الأشغال العامة والنقل',
        ],
        'description' => [
            'en' => 'Responsible for transportation infrastructure and public works.',
            'ar' => 'مسؤولة عن البنية التحتية للنقل والأشغال العامة.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Social Affairs',
            'ar' => 'وزارة الشؤون الاجتماعية',
        ],
        'description' => [
            'en' => 'Manages social programs, welfare, and community services.',
            'ar' => 'تشرف على البرامج الاجتماعية والرعاية والخدمات المجتمعية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Youth and Sports',
            'ar' => 'وزارة الشباب والرياضة',
        ],
        'description' => [
            'en' => 'Promotes youth engagement, sports, and recreational programs.',
            'ar' => 'تعزز مشاركة الشباب والرياضة والبرامج الترفيهية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Foreign Affairs and Emigrants',
            'ar' => 'وزارة الخارجية والمغتربين',
        ],
        'description' => [
            'en' => 'Handles diplomatic relations and expatriate services.',
            'ar' => 'تعنى بالعلاقات الدبلوماسية وخدمات المغتربين.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Foreign Affairs and International Cooperation',
            'ar' => 'وزارة الخارجية والتعاون الدولي',
        ],
        'description' => [
            'en' => 'Manages foreign policy and international cooperation.',
            'ar' => 'تشرف على السياسة الخارجية والتعاون الدولي.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Energy and Infrastructure',
            'ar' => 'وزارة الطاقة والبنية التحتية',
        ],
        'description' => [
            'en' => 'Responsible for energy projects and infrastructure development.',
            'ar' => 'مسؤولة عن مشاريع الطاقة وتطوير البنية التحتية.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Industry and Advanced Technology',
            'ar' => 'وزارة الصناعة والتكنولوجيا المتقدمة',
        ],
        'description' => [
            'en' => 'Focuses on industrial innovation and technology advancement.',
            'ar' => 'تركز على الابتكار الصناعي وتقدم التكنولوجيا.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Human Resources and Emiratisation',
            'ar' => 'وزارة الموارد البشرية والتوطين',
        ],
        'description' => [
            'en' => 'Oversees workforce policies and employment initiatives.',
            'ar' => 'تشرف على سياسات القوى العاملة ومبادرات التوظيف.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Culture and Youth',
            'ar' => 'وزارة الثقافة والشباب',
        ],
        'description' => [
            'en' => 'Promotes cultural activities, arts, and youth programs.',
            'ar' => 'تعزز الأنشطة الثقافية والفنون وبرامج الشباب.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Climate Change and Environment',
            'ar' => 'وزارة التغير المناخي والبيئة',
        ],
        'description' => [
            'en' => 'Manages climate change initiatives and environmental protection.',
            'ar' => 'تشرف على مبادرات تغير المناخ وحماية البيئة.',
        ],
    ],
    [
        'name' => [
            'en' => 'Ministry of Cabinet Affairs',
            'ar' => 'وزارة شؤون مجلس الوزراء',
        ],
        'description' => [
            'en' => 'Coordinates cabinet operations and government policies.',
            'ar' => 'تنظم أعمال مجلس الوزراء والسياسات الحكومية.',
        ],
    ],
];  // جلب كل الولايات
         $states = DB::table('states')->pluck('id');

        foreach ($states as $state_id) {
            $cities = DB::table('cities')->where('state_id', $state_id)->pluck('id');
            $cityCount = $cities->count();

            // نولد 10 أرقام خاصة بالـ state
            $phones = $this->generatePhones($state_id, 10);

            if ($cityCount > 0) {
                foreach ($government_entities as $index => $entity) {
                    $city_id = $cities[$index % $cityCount]; // توزيع دائري
                    $phone   = $phones[$index % count($phones)];

                    GovernmentEntity::create(array_merge($entity, [
                        'state_id' => $state_id,
                        'city_id'  => $city_id,
                        'phone'    => $phone,
                    ]));
                }
            } else {
                foreach ($government_entities as $index => $entity) {
                    $phone   = $phones[$index % count($phones)];

                    GovernmentEntity::create(array_merge($entity, [
                        'state_id' => $state_id,
                        'city_id'  => null,
                        'phone'    => $phone,
                    ]));
                }
            }
        }
    }

    private function generatePhones($state_id, $count = 10): array
    {
        $phones = [];
        for ($i = 0; $i < $count; $i++) {
            $phones[] = '09' . str_pad($state_id, 2, '0', STR_PAD_LEFT) . rand(1000000, 9999999);
        }
        return $phones;
    }
}
