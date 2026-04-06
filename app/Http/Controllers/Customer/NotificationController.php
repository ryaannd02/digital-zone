<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
public function index()
{
    $notifications = Notification::where('user_id', Auth::id())
        ->latest()
        ->paginate(10); // 🔥 ambil 10 dulu

    // mark as read
    Notification::where('user_id', Auth::id())
        ->update(['is_read' => true]);

    return view('customer.notifications.index', compact('notifications'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->page;

        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->paginate(10, ['*'], 'page', $page);

        return view('customer.notifications.partials', compact('notifications'))->render();
    }
}
