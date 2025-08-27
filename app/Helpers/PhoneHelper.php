<?php

namespace App\Helpers;

class PhoneHelper
{
    /**
     * تحويل الرقم المحلي إلى صيغة دولية (E.164)
     *
     * @param string $phone
     * @param string $countryCode
     * @return string
     */
    public static function formatToInternational($phone, $defaultCode = '+963')
    {
        // إزالة أي رموز غير أرقام
        $phone = preg_replace('/\D/', '', $phone);

        // إذا الرقم بصيغة 00xxxxxxxxx → نحوله لـ +xxxxxxxx
        if (strpos($phone, '00') === 0) {
            $phone = '+'.substr($phone, 2);

        // إذا الرقم أصلاً يبدأ بـ +
        } elseif (strpos($phone, '+') === 0) {
            return $phone;

        // غير هيك → نضيف كود الدولة
        } else {
            // نحذف الصفر الأول إذا موجود
            if (strpos($phone, '0') === 0) {
                $phone = substr($phone, 1);
            }

            $phone = $defaultCode.$phone;
        }

        return $phone;
    }
}

