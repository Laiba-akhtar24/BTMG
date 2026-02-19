<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use App\Mail\SubscriberMessage;
use Illuminate\Support\Facades\Mail;
use MongoDB\Client as MongoClient;

class SubscriberController extends Controller
{
    private $collection;

    public function __construct()
{
    $client = new Client(config('database.mongodb.uri'));
   $db = $client->selectDatabase("btmg_trainings"); // your DB name
        $this->collection = $db->selectCollection("subscribers");
}


    // Store subscriber
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $this->collection->insertOne([
            'email' => $request->email,
            'status' => 'active',
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Subscribed Successfully!');
    }

    // Show subscribers
    public function index()
    {
       $subscribers = $this->collection->find()->toArray();

        return view('admin.subscribers', compact('subscribers'));
    }

public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'selected_emails' => 'required|array|min:1',
    ]);

    $message = $request->message;
    $emails = $request->selected_emails;

           foreach ($request->selected_emails as $email) {
            Mail::to($email)->send(new SubscriberMessage($request->message));
           }

    return back()->with('success', 'Message sent to selected subscribers!');
}
 public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        // Check if email already exists
        $exists = $this->collection->findOne(['email' => $email]);
        if ($exists) {
            return back()->withErrors(['email' => 'This email is already subscribed.']);
        }

        // Insert email into MongoDB
        $this->collection->insertOne([
            'email' => $email,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Thank you for subscribing!');
    }
}
