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
    ['name_en' => 'Ministry of Interior', 'name_ar' => 'وزارة الداخلية', 'description' => 'Responsible for internal security, police, and civil affairs.'],
    ['name_en' => 'Ministry of Defence', 'name_ar' => 'وزارة الدفاع', 'description' => 'Oversees the armed forces and national defense.'],
    ['name_en' => 'Ministry of Foreign Affairs and Expatriates', 'name_ar' => 'وزارة الخارجية والمغتربين', 'description' => 'Handles international relations and citizen services abroad.'],
    ['name_en' => 'Ministry of Justice', 'name_ar' => 'وزارة العدل', 'description' => 'Manages courts, legal affairs, and law enforcement.'],
    ['name_en' => 'Ministry of Awqaf', 'name_ar' => 'وزارة الأوقاف', 'description' => 'Responsible for religious endowments and mosques.'],
    ['name_en' => 'Ministry of Higher Education', 'name_ar' => 'وزارة التعليم العالي', 'description' => 'Oversees universities and higher education institutions.'],
    ['name_en' => 'Ministry of Social and Labour Affairs', 'name_ar' => 'وزارة الشؤون الاجتماعية والعمل', 'description' => 'Manages social services, labor regulations, and employment policies.'],
    ['name_en' => 'Ministry of Finance', 'name_ar' => 'وزارة المالية', 'description' => 'Responsible for the national budget, taxation, and public finances.'],
    ['name_en' => 'Ministry of Economy and Foreign Trade', 'name_ar' => 'وزارة الاقتصاد والتجارة الخارجية', 'description' => 'Oversees economic policies and international trade.'],
    ['name_en' => 'Ministry of Health', 'name_ar' => 'وزارة الصحة', 'description' => 'Manages public health, hospitals, and medical services.'],
    ['name_en' => 'Ministry of Local Administration and Environment', 'name_ar' => 'وزارة الإدارة المحلية والبيئة', 'description' => 'Responsible for local governance and environmental protection.'],
    ['name_en' => 'Ministry of Communications and Information Technology', 'name_ar' => 'وزارة الاتصالات وتكنولوجيا المعلومات', 'description' => 'Oversees telecommunications, IT, and digital transformation.'],
    ['name_en' => 'Ministry of Agriculture and Agrarian Reform', 'name_ar' => 'وزارة الزراعة والإصلاح الزراعي', 'description' => 'Responsible for agriculture, land reform, and rural development.'],
    ['name_en' => 'Ministry of Education', 'name_ar' => 'وزارة التربية', 'description' => 'Oversees primary and secondary education.'],
    ['name_en' => 'Ministry of Public Works and Housing', 'name_ar' => 'وزارة الأشغال العامة والإسكان', 'description' => 'Responsible for public infrastructure, roads, and housing projects.'],
    ['name_en' => 'Ministry of Interior and Municipalities', 'name_ar' => 'وزارة الداخلية والبلديات', 'description' => 'Manages municipal affairs and local administration.'],
    ['name_en' => 'Ministry of Education and Higher Education', 'name_ar' => 'وزارة التربية والتعليم العالي', 'description' => 'Responsible for overall education policy from primary to higher education.'],
    ['name_en' => 'Ministry of Public Health', 'name_ar' => 'وزارة الصحة العامة', 'description' => 'Focuses on public health initiatives and preventive care.'],
    ['name_en' => 'Ministry of Economy and Trade', 'name_ar' => 'وزارة الاقتصاد والتجارة', 'description' => 'Develops economic strategies and trade regulations.'],
    ['name_en' => 'Ministry of Energy and Water', 'name_ar' => 'وزارة الطاقة والمياه', 'description' => 'Oversees energy production and water resources management.'],
    ['name_en' => 'Ministry of Environment', 'name_ar' => 'وزارة البيئة', 'description' => 'Responsible for environmental protection and sustainability.'],
    ['name_en' => 'Ministry of Agriculture', 'name_ar' => 'وزارة الزراعة', 'description' => 'Manages farming, livestock, and agricultural policy.'],
    ['name_en' => 'Ministry of Industry', 'name_ar' => 'وزارة الصناعة', 'description' => 'Oversees industrial development and manufacturing sectors.'],
    ['name_en' => 'Ministry of Public Works and Transport', 'name_ar' => 'وزارة الأشغال العامة والنقل', 'description' => 'Responsible for transportation infrastructure and public works.'],
    ['name_en' => 'Ministry of Social Affairs', 'name_ar' => 'وزارة الشؤون الاجتماعية', 'description' => 'Manages social programs, welfare, and community services.'],
    ['name_en' => 'Ministry of Youth and Sports', 'name_ar' => 'وزارة الشباب والرياضة', 'description' => 'Promotes youth engagement, sports, and recreational programs.'],
    ['name_en' => 'Ministry of Foreign Affairs and Emigrants', 'name_ar' => 'وزارة الخارجية والمغتربين', 'description' => 'Handles diplomatic relations and expatriate services.'],
    ['name_en' => 'Ministry of Foreign Affairs and International Cooperation', 'name_ar' => 'وزارة الخارجية والتعاون الدولي', 'description' => 'Manages foreign policy and international cooperation.'],
    ['name_en' => 'Ministry of Energy and Infrastructure', 'name_ar' => 'وزارة الطاقة والبنية التحتية', 'description' => 'Responsible for energy projects and infrastructure development.'],
    ['name_en' => 'Ministry of Industry and Advanced Technology', 'name_ar' => 'وزارة الصناعة والتكنولوجيا المتقدمة', 'description' => 'Focuses on industrial innovation and technology advancement.'],
    ['name_en' => 'Ministry of Human Resources and Emiratisation', 'name_ar' => 'وزارة الموارد البشرية والتوطين', 'description' => 'Oversees workforce policies and employment initiatives.'],
    ['name_en' => 'Ministry of Culture and Youth', 'name_ar' => 'وزارة الثقافة والشباب', 'description' => 'Promotes cultural activities, arts, and youth programs.'],
    ['name_en' => 'Ministry of Climate Change and Environment', 'name_ar' => 'وزارة التغير المناخي والبيئة', 'description' => 'Manages climate change initiatives and environmental protection.'],
    ['name_en' => 'Ministry of Cabinet Affairs', 'name_ar' => 'وزارة شؤون مجلس الوزراء', 'description' => 'Coordinates cabinet operations and government policies.'],
];

        // جلب كل المدن
        $all_cities = DB::table('cities')->pluck('id');

        // إدراج كل جهة لكل مدينة
        foreach ($government_entities as $entity) {
            foreach ($all_cities as $city_id) {
                GovernmentEntity::create(array_merge($entity,
                 ['state_id' => DB::table('cities')->where('id', $city_id)->value('state_id'), 'city_id' => $city_id]));
            }
        }
    }
}
