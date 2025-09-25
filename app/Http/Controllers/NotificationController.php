<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNotificationSettingsRequest;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    private NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index(): View
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $notifications = $this->notificationService->getUserNotifications($user);

        return view('notifications.index', compact('notifications'));
    }

    public function show(int $id): View
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $notification = $this->notificationService->getNotification($user, $id);

        return view('notifications.show', compact('notification'));
    }

    public function updateSettingsWeb(UpdateNotificationSettingsRequest $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $data = $request->validated();

        $this->notificationService->updateSettings($user, $data['notifications_enabled']);

        return redirect()->route('welcome')
                         ->with('success', 'Notification settings updated successfully.');
    }
}
