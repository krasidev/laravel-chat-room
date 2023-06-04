<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRoomNotificationRequest;
use App\Models\User;
use App\Notifications\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class ChatRoomNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('ChatRoomNotifications/Index', [
            'lang.content.chat-room-notifications' => __('content.chat-room-notifications'),
            'chatRoomNotifications' => $request->user()->chatRoomNotifications,
            'users' => User::whereNot('id', $request->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRoomNotificationRequest $request)
    {
        $data = $request->only(['notifiable_id', 'message']);
        $author = $request->user();

        $users = User::query();

        if (isset($data['notifiable_id'])) {
            $users->whereIn('id', [
                $author->id,
                $data['notifiable_id']
            ]);
        }

        Notification::send($users->get(), new ChatRoom(
            $author,
            $data['message']
        ));

        return redirect()->route('chat-room-notifications.index');
    }
}
