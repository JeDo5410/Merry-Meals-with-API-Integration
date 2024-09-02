<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Member;
use App\Models\Order;
use App\Http\Requests\StoreFeedbackRequest;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\Member;
use Auth;

class FeedbackController extends Controller
{
    public function create($order_id)
    {
        $order = Order::findOrFail($order_id);
        $member = Member::where('user_id', Auth::id())->first();
        
        if (!$member) {
            return redirect()->back()->with('error', 'Member record not found.');
        }
        
        return view('Users.Member.feedback.create', compact('order', 'member'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string',
        ]);
        
        $user_id = Auth::id();
        $member = Member::where('user_id', $user_id)->first();
        
        if (!$member) {
            return redirect()->back()->with('error', 'Unable to submit feedback. Member record not found.');
        }
        
        $feedback = Feedback::create([
            'order_id' => $validated['order_id'],
            'member_id' => $member->id,
            'rating' => $validated['rating'],
            'comments' => $validated['comments'],
            'feedback_date' => now(),
        ]);

        return redirect()->route('feedback.show', $feedback)
            ->with('success', 'Feedback submitted successfully!');
    }

    public function show($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('Users.Member.feedback.show', compact('feedback'));
    }
}
