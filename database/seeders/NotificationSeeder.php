<?php

namespace Database\Seeders;

use App\Enum\NotificationEnum;
use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        // // إشعار بانتهاء عقد مقدم الخدمة
        Notification::create([
            'title' => 'Service Provider Contract Expiry',
            'message' => 'The service provider’s contract will expire in 28 days. Please take necessary action.',
            'target_type' => NotificationEnum::PROVIDER->value,
            'target_id' => 1,
            'is_read' => false,
            'send_at' => $now->addDays(2),
            'created_by' => 1,
        ]);

        // إشعار تقديم طلب كمقدم خدمة
        Notification::create([
            'title' => 'Apply to Become a Service Provider',
            'message' => 'A new request has been submitted to become a service provider. Please review it.',
            'target_type' => NotificationEnum::ALL->value,
            'target_id' => null,
            'is_read' => false,
            'send_at' => $now->addHours(5),
            'created_by' => 1,
        ]);

        // إشعار إرسال طلب اتصل بنا
        Notification::create([
            'title' => 'Contact Us Request Submitted',
            'message' => 'A user has submitted a request through the Contact Us form.',
            'target_type' => NotificationEnum::USER->value,
            'target_id' => 3,
            'is_read' => true,
            'send_at' => $now->subDay(),
            'created_by' => 2,
        ]);
    }
}
