<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MongoDB\Client;

class CourseInquiryController extends Controller
{
    protected $collection;

    public function __construct()
    {
        $client = new Client('mongodb://127.0.0.1:27017');
        $this->collection = $client->btmg_trainings->course_inquiries;
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $this->collection->insertOne([
            'course_name' => $request->course_name,
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'message'     => $request->message,
            'replied'     => false,
            'viewed'      => false,
            'created_at'  => now()
        ]);

        return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
    }
    
}
