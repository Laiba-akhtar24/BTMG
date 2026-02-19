<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use MongoDB\Client;
    use Illuminate\Support\Facades\Mail;

class ContactLeadController extends Controller
{
    public function index()
    {
        $client = new Client('mongodb://127.0.0.1:27017');
        $collection = $client->btmg_trainings->contacts;

        $leadsCursor = $collection->find([], ['sort' => ['_id' => -1]]);
        $leads = iterator_to_array($leadsCursor);

        return view('admin.contact-leads.index', compact('leads'));
    }


public function sendReply(Request $request)
{
    $data = $request->validate([
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    Mail::raw($data['message'], function ($message) use ($data) {
        $message->to($data['email'])
                ->subject('Reply from BTMG');
    });

    return back()->with('success', 'Reply sent successfully!');
}

}
