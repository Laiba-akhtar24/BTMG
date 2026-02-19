<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client as MongoClient;
use MongoDB\BSON\UTCDateTime;

class ContactController extends Controller
{
    protected $collection;

    public function __construct()
    {
        // MongoDB connection
        $client = new MongoClient("mongodb://127.0.0.1:27017");
        $this->collection = $client->btmg_trainings->contacts;
        
    }

    // Show contact form
    public function index()
    {
        return view('contact-us'); // existing blade
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate form input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'required|string',
            'consent' => 'required'
        ]);

        // Insert into MongoDB
        $this->collection->insertOne([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'message' => $data['message'],
            'consent' => $data['consent'] === 'on' ? true : false,
            'replied' => 'Pending',   // default for admin
            'viewed' => 'Not Viewed', // default for admin
            'created_at' => new UTCDateTime()
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
public function reply(Request $request, $id)
{
    // Find the contact/lead in MongoDB by _id
    $lead = $this->collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);

    if ($lead) {
        \Mail::to($lead['email'])->send(new \App\Mail\ContactReply($request->reply_message));

        // Update replied status in MongoDB
        $this->collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => ['replied' => 'Yes']]
        );

        return back()->with('success', 'Reply sent successfully!');
    }

    return back()->with('error', 'Lead not found.');
}

// php artisan make:mail ContactReply
public $messageContent;



public function build()
{
    return $this->subject('Reply from Admin')
                ->view('emails.contact_reply')
                ->with(['content' => $this->messageContent]);
}
public function markViewed($id)
{
    // Update MongoDB document
    $this->collection->updateOne(
        ['_id' => new \MongoDB\BSON\ObjectId($id)],
        ['$set' => ['viewed' => 'Viewed']]
    );

    return response()->json(['success' => true]);
}

}
