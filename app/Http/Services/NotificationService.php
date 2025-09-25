<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    /**
     * Get all notifications for a given user, ordered by send_at descending
     */
    public function getUserNotifications(User $user): Collection
    {
        return Notification::where('target_id', $user->id)
                           ->orderBy('send_at', 'desc')
                           ->get();
    }

    /**
     * Get single notification and mark as read
     */
    public function getNotification(User $user, int $id): Notification
    {
        $notification = Notification::findOrFail($id);

        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return $notification;
    }

    /**
     * Update user's notification settings
     */
    public function updateSettings(User $user, bool $enabled): void
    {
        $user->update(['notifications_enabled' => $enabled]);
    }
}
