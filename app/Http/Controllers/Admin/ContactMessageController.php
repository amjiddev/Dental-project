<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $query = ContactMessage::latest();
        
        // Filter unread messages if requested from notifications
        if (request()->has('filter') && request('filter') === 'unread') {
            $query = $query->unread();
        }
        
        // Handle AJAX request for modal
        if (request()->has('ajax') && request('ajax') === 'true' && request()->expectsJson()) {
            $messages = $query->limit(50)->get();
            return response()->json([
                'messages' => $messages->map(function ($msg) {
                    return [
                        'id' => $msg->id,
                        'name' => $msg->name,
                        'email' => $msg->email,
                        'phone' => $msg->phone,
                        'subject' => $msg->subject,
                        'message' => $msg->message,
                        'created_at' => $msg->created_at->format('M d, Y H:i'),
                        'time_ago' => $msg->created_at->diffForHumans(),
                    ];
                })
            ]);
        }
        
        $messages = $query->paginate(15);
        $unreadCount = ContactMessage::unread()->count();
        
        return view('admin.contact-messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function getUnread()
    {
        $count = ContactMessage::unread()->count();
        return response()->json(['count' => $count]);
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();
        
        // Return JSON if AJAX, otherwise redirect
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Message marked as read.');
    }
}
