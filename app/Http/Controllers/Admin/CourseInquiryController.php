<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReply;



class CourseInquiryController extends Controller
{
    
   protected $db;
    protected $collection; // 👈 add this

    public function __construct()
    {
        $client = new Client('mongodb://127.0.0.1:27017');
        $this->db = $client->btmg_trainings; // db name
        $this->collection = $this->db->course_inquiries; // 👈 collection name
    }

    // ✅ STORE (Frontend Form Submission)
    public function store(Request $request)
{
    $request->validate([
        'course_name' => 'required',
        'name'        => 'required',
        'email'       => 'required|email',
        'message'     => 'required',
    ]);

    $this->collection->insertOne([
        'course_name' => $request->course_name,
        'name'        => $request->name,
        'email'       => $request->email,
        'phone'       => $request->phone,
        'message'     => $request->message,
        'viewed'      => false,
        'created_at' => date('Y-m-d'),

    ]);

    return redirect()->back()->with('success', 'Your inquiry has been submitted successfully.');
}

    // Show all inquiries (Admin Panel)
   public function index()
    {
        // now $this->collection exist
        $inquiriesCursor = $this->collection->find([], ['sort' => ['_id' => -1]]);
        $inquiries = iterator_to_array($inquiriesCursor);

        return view('course-inquiries.index', compact('inquiries'));
    }

    // View single inquiry (AJAX)
   public function view($id)
{
    try {
        // Find inquiry
        $inquiry = $this->db->course_inquiries->findOne([
            '_id' => new \MongoDB\BSON\ObjectId($id)
        ]);

        if (!$inquiry) {
            return response()->json(['error' => 'Inquiry not found'], 404);
        }

        // Convert BSONDocument to array safely
        $inquiryArray = json_decode(json_encode($inquiry), true);

        // Flatten and default values
        $data = [
            '_id' => (string)($inquiryArray['_id']['$oid'] ?? $inquiryArray['_id'] ?? ''),
            'name' => $inquiryArray['name'] ?? '',
            'email' => $inquiryArray['email'] ?? '',
            'phone' => $inquiryArray['phone'] ?? '',
            'message' => $inquiryArray['message'] ?? '',
            'course_name' => $inquiryArray['course_name'] ?? '',
            'level' => $inquiryArray['level'] ?? ''
        ];

        // Fetch launch date from launch_dates collection
        $launch_date = '';
        if (!empty($data['course_name'])) {
            $launch = $this->db->launch_dates->findOne(['course_name' => $data['course_name']]);
            if ($launch) {
                $launchArray = json_decode(json_encode($launch), true);
                $launch_date = $launchArray['launch_date'] ?? '';
                if (empty($data['level'])) {
            $data['level'] = $launchArray['level'] ?? '';
        }
            }
        }
        $data['launch_date'] = $launch_date;

        return response()->json($data);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    // Mark inquiry as viewed
    public function markViewed($id)
{
    try {
        $this->db->course_inquiries->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => ['viewed' => true]]
        );

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}

     public function sendReply(Request $request, $id)
{
    $request->validate([
        'replyMessage' => 'required|string'
    ]);

    $inquiry = $this->db->course_inquiries->findOne([
        '_id' => new ObjectId($id)
    ]);

    if (!$inquiry) {
        return back()->with('error', 'Inquiry not found');
    }

    // Send email using Mailable
    Mail::to($inquiry['email'])
        ->send(new InquiryReply($request->replyMessage));

    // Update replied status
    $this->db->course_inquiries->updateOne(
        ['_id' => new ObjectId($id)],
        ['$set' => ['replied' => 'Replied']]
    );

    return back()->with('success', 'Reply sent successfully!');
}
public function destroy($id)
{
    try {
        $this->db->course_inquiries->deleteOne([
            '_id' => new \MongoDB\BSON\ObjectId($id)
        ]);

        return redirect()->back()->with('success', 'Inquiry deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

}
