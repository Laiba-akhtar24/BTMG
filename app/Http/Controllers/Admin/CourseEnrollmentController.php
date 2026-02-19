<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\UTCDateTime;
use MongoDB\BSON\ObjectId;

class CourseEnrollmentController extends Controller
{
    protected $db;

    public function __construct()
    {
        $client = new Client('mongodb://127.0.0.1:27017'); // MongoDB connection
        $this->db = $client->btmg_trainings; // database name
    }

    // Show enrollments table (Admin view)
   public function index()
{
    // 1️⃣ Fetch all enrollments
    $enrollments = $this->db->course_enrollments->find()->toArray();

    // 2️⃣ Fetch all courses and key them by _id string
    $courses = $this->db->courses->find()->toArray();
    $coursesById = [];
    foreach ($courses as $course) {
        $coursesById[(string)$course['_id']] = $course; // key by string
    }

    // 3️⃣ Merge course info into enrollments
    foreach ($enrollments as $key => $enrollment) {
        $courseId = isset($enrollment['course_id']) ? (string)$enrollment['course_id'] : null;

        if ($courseId && isset($coursesById[$courseId])) {
            $course = $coursesById[$courseId];
            $enrollments[$key]['course_level'] = $course['level'] ?? '-';
            $enrollments[$key]['course_name'] = $enrollment['course_name'] ?? ($course['name'] ?? '-');
            $enrollments[$key]['course_type'] = $enrollment['course_type'] ?? ($course['type'] ?? '-');
        } else {
            $enrollments[$key]['course_level'] = '-';
        }
    }

    // 4️⃣ Pass to view
    return view('admin.course-enrollments.index', compact('enrollments'));
}


    // Store enrollment from frontend form
   public function store(Request $request)
{
    $request->validate([
        'course_name' => 'required|string',
        'registration_type' => 'nullable|string',
        'name'        => 'required|string',
        'email'       => 'required|email',
        'phone'       => 'nullable|string',
        'message'     => 'nullable|string',
    ]);

    // MongoDB data

$data = [
    'course_id' => new ObjectId($request->course_id),
    'course_name' => $request->course_name,
    'course_type' => $request->registration_type ?? 'Individual',
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone ?? '',
    'message' => $request->message ?? '',
    'status' => 'Pending',
    'created_at' => new \MongoDB\BSON\UTCDateTime(),
    'updated_at' => new \MongoDB\BSON\UTCDateTime(),
];



    // MongoDB client
    $client = new \MongoDB\Client('mongodb://127.0.0.1:27017');
    $db = $client->btmg_trainings;

    // Insert
    $insertResult = $db->course_enrollments->insertOne($data);

    // Redirect back with success
    return redirect()->back()->with('success', 'Enrollment submitted successfully!');
}

    // Delete enrollment
    public function destroy($id)
    {
        $this->db->course_enrollments->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return redirect()->back()->with('success', 'Enrollment deleted successfully!');
    }

   
}
