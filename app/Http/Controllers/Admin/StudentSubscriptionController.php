<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\SubscriptionCreated;
use Illuminate\Support\Facades\Mail;

class StudentSubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = StudentSubscription::paginate(10);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $subscription = new StudentSubscription();
        return view('admin.subscriptions.add-edit', compact('subscription'));    
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'std_name' => 'required',
    //         'std_email' => 'required|email|unique:student_subscriptions,std_email',
    //         'std_id' => 'required|unique:student_subscriptions,std_id',
    //         'sub_start_date' => 'required|date',
    //         'sub_end_date' => 'required|date|after:sub_start_date',
    //         'sub_fee' => 'required|numeric',
    //         'status' => 'required|in:on,off',
    //     ]);

    //     $validated['password'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    //     StudentSubscription::create($validated);

    //     return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully!');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'std_name' => 'required',
            'std_email' => 'required|email|unique:student_subscriptions,std_email',
            'std_id' => 'required|unique:student_subscriptions,std_id',
            'sub_start_date' => 'required|date',
            'sub_end_date' => 'required|date|after:sub_start_date',
            'sub_fee' => 'required|numeric',
            'status' => 'required|in:on,off',
        ]);

        // Generate random password
        $validated['password'] = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create subscription
        $subscription = StudentSubscription::create($validated);

        // Send email
        Mail::to($validated['std_email'])->send(new SubscriptionCreated($subscription));

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription created successfully!');
    }

    public function edit(StudentSubscription $subscription)
    {
        return view('admin.subscriptions.add-edit', compact('subscription'));
    }

    public function update(Request $request, StudentSubscription $subscription)
    {
        $validated = $request->validate([
            'std_name' => 'required',
            'std_email' => 'required|email|unique:student_subscriptions,std_email,' . $subscription->id,
            'std_id' => 'required|unique:student_subscriptions,std_id,' . $subscription->id,
            'sub_start_date' => 'required|date',
            'sub_end_date' => 'required|date|after:sub_start_date',
            'sub_fee' => 'required|numeric',
            'status' => 'required|in:on,off',
            'password' => 'nullable|min:6', // Optional password field
        ]);

        // If password is filled, update it; else, remove to keep current
        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        $subscription->update($validated);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully!');
    }


    public function destroy(StudentSubscription $subscription)
    {
        $subscription->delete();
        return redirect()->back()->with('success', 'Subscription deleted!');
    }
}