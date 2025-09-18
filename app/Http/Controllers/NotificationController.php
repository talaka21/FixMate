<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\UpdateNotificationSettingsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;


class NotificationController extends Controller
{
    // List notifications for the authenticated user (API)
  public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $notifications = Notification::where('target_id', $user->id)
                                     ->orderBy('send_at', 'desc')
                                     ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function show(int $id): View
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $notification = Notification::findOrFail($id);

        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return view('notifications.show', compact('notification'));
    }

    public function updateSettingsWeb(UpdateNotificationSettingsRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $data = $request->validated();

        $user->update([
            'notifications_enabled' => $data['notifications_enabled'],
        ]);

        return redirect()->route('welcome')
                         ->with('success', 'Notification settings updated successfully.');
    }

}
