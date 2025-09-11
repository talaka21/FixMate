<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // قائمة الإشعارات للمستخدم (API)
    public function index(Request $request)
    {
        $notifications = Notification::where('target_id', $request->user()->id)
                                     ->orderBy('send_at', 'desc')
                                     ->get()
                                     ->map(function ($notif) {
                                         return [
                                             'id' => $notif->id,
                                             'title' => $notif->getTranslation('title', app()->getLocale()),
                                             'message' => $notif->getTranslation('message', app()->getLocale()),
                                             'date' => $notif->send_at->format('Y-m-d H:i'),
                                             'is_read' => $notif->is_read,
                                             'target_type' => $notif->target_type,
                                             'target_id' => $notif->target_id,
                                         ];
                                     });

        return response()->json($notifications);
    }

    // تفاصيل إشعار معين (API)
    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return response()->json([
            'id' => $notification->id,
            'title' => $notification->getTranslation('title', app()->getLocale()),
            'message' => $notification->getTranslation('message', app()->getLocale()),
            'date' => $notification->send_at->format('Y-m-d H:i'),
            'is_read' => $notification->is_read,
            'target_type' => $notification->target_type,
            'target_id' => $notification->target_id,
        ]);
    }

    // تحديث حالة الإشعارات (API)
    public function updateSettingsApi(Request $request)
    {
        $request->validate([
            'notifications_enabled' => 'required|boolean',
        ]);

        $user = $request->user();
        $user->update([
            'notifications_enabled' => $request->notifications_enabled
        ]);

        return response()->json([
            'message' => 'Notification settings updated successfully.',
            'notifications_enabled' => $user->notifications_enabled
        ]);
    }

    // عرض صفحة إعدادات الإشعارات (Web)
    public function settings()
    {
        $user = auth()->user();
        return view('notifications.settings', compact('user'));
    }

    // تحديث حالة الإشعارات من صفحة Web
    public function updateSettingsWeb(Request $request)
    {
        $request->validate([
            'notifications_enabled' => 'required|boolean',
        ]);

        $user = auth()->user();
        $user->update([
            'notifications_enabled' => $request->notifications_enabled
        ]);

        return redirect()->back()->with('success', 'Notification settings updated successfully.');
    }
}
