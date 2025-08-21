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
           DB::table('subcategories')->delete();

        $subcategories = [
    // Healthcare
    ['category_id' => 1, 'name_en' => 'Hospitals',           'name_ar' => 'المستشفيات',        'description' => 'Facilities providing inpatient and outpatient medical care.'],
    ['category_id' => 1, 'name_en' => 'Clinics',             'name_ar' => 'العيادات',          'description' => 'Centers offering outpatient medical services.'],
    ['category_id' => 1, 'name_en' => 'Pharmacies',          'name_ar' => 'الصيدليات',         'description' => 'Places to purchase medicines and health products.'],
    ['category_id' => 1, 'name_en' => 'Emergency Services',  'name_ar' => 'خدمات الطوارئ',    'description' => 'Immediate medical assistance and ambulance services.'],

    // Education
    ['category_id' => 2, 'name_en' => 'Schools',             'name_ar' => 'المدارس',           'description' => 'Institutions for primary and secondary education.'],
    ['category_id' => 2, 'name_en' => 'Universities',        'name_ar' => 'الجامعات',          'description' => 'Higher education institutions offering degrees.'],
    ['category_id' => 2, 'name_en' => 'Vocational Training', 'name_ar' => 'التدريب المهني',   'description' => 'Skill development and technical training programs.'],

    // Transportation
    ['category_id' => 3, 'name_en' => 'Public Transport',    'name_ar' => 'النقل العام',       'description' => 'Bus, metro, and other public transport services.'],
    ['category_id' => 3, 'name_en' => 'Vehicle Registration','name_ar' => 'تسجيل المركبات',   'description' => 'Official registration of vehicles with authorities.'],
    ['category_id' => 3, 'name_en' => 'Driving Licenses',    'name_ar' => 'رخص القيادة',       'description' => 'Issuance of driving licenses for individuals.'],

    // Finance
    ['category_id' => 4, 'name_en' => 'Banking',             'name_ar' => 'الخدمات المصرفية',  'description' => 'Services related to bank accounts and transactions.'],
    ['category_id' => 4, 'name_en' => 'Taxes',               'name_ar' => 'الضرائب',          'description' => 'Payment and management of taxes.'],
    ['category_id' => 4, 'name_en' => 'Investments',         'name_ar' => 'الاستثمارات',      'description' => 'Financial investments and asset management services.'],

    // Legal
    ['category_id' => 5, 'name_en' => 'Court Services',      'name_ar' => 'خدمات المحاكم',     'description' => 'Services provided by courts and legal institutions.'],
    ['category_id' => 5, 'name_en' => 'Notary',              'name_ar' => 'التوثيق',          'description' => 'Authentication and notarization of official documents.'],
    ['category_id' => 5, 'name_en' => 'Legal Aid',           'name_ar' => 'المساعدة القانونية','description' => 'Support and legal consultation for citizens.'],

    // Housing
    ['category_id' => 6, 'name_en' => 'Real Estate',         'name_ar' => 'العقارات',          'description' => 'Buying, selling, and renting properties.'],
    ['category_id' => 6, 'name_en' => 'Utilities',           'name_ar' => 'المرافق',           'description' => 'Provision and payment of electricity, water, and gas.'],
    ['category_id' => 6, 'name_en' => 'Building Permits',    'name_ar' => 'تصاريح البناء',    'description' => 'Official permissions for construction and renovations.'],

    // Business
    ['category_id' => 7, 'name_en' => 'Company Registration','name_ar' => 'تسجيل الشركات',    'description' => 'Legal registration of new companies.'],
    ['category_id' => 7, 'name_en' => 'Licenses',            'name_ar' => 'التراخيص',          'description' => 'Issuance of business and operational licenses.'],
    ['category_id' => 7, 'name_en' => 'Trade',               'name_ar' => 'التجارة',           'description' => 'Commercial trading and business-related services.'],
];
        // التأكد أن الحقول موجودة في $fillable داخل Model Subcategory
        Subcategory::insert($subcategories);
    }
    }

