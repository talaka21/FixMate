<?php

namespace Database\Seeders;

use App\Models\GovernmentEntity;
use Illuminate\Database\Seeder;
use App\Enum\stateStatusEnum;

class GovernmentEntitieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entities = [
            [
                'entity_name' => 'Ministry of Health',
                'description' => 'Responsible for public health services.',
                'image' => 'entities/health_ministry.png',
                'phone' => '0111234567',
                'website' => 'https://moh.gov.sy',
                'state_id' => 1,
                'city_id' => 1,
                  'status' => stateStatusEnum::ACTIVE->value,
            ],
            [
                'entity_name' => 'Ministry of Higher Education',
                'description' => 'Oversees universities and higher institutes.',
                'image' => 'entities/higher_education.png',
                'phone' => '0117654321',
                'website' => 'https://mohe.gov.sy',
                'state_id' => 1,
                'city_id' => 2,
                'status' => stateStatusEnum::ACTIVE->value,
            ],
            [
                'entity_name' => 'Damascus Municipality',
                'description' => 'Manages municipal services in Damascus city.',
                'image' => null,
                'phone' => '0113344556',
                'website' => null,
                'state_id' => 1,
                'city_id' => 1,
                'status' => stateStatusEnum::INACTIVE->value,
            ],
        ];

        foreach ($entities as $entity) {
            GovernmentEntity::create($entity);
        }
    }
}
