<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class CourseController extends Controller
{
    protected $db;

    public function __construct()
    {
        $client = new Client('mongodb://127.0.0.1:27017');
        $this->db = $client->btmg_trainings;
    }

    // ================= ADMIN METHODS =================
    public function index()
    {
        $courses = $this->db->courses
            ->find([], ['sort' => ['launch_date' => -1]])
            ->toArray();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = $this->db->categories
            ->find([], ['sort' => ['order' => 1]])
            ->toArray();

        return view('admin.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $status = $request->has('status') ? 'Active' : 'Inactive';

        $courseData = [
            'name' => $request->name,
            'category' => $request->category,
            'level' => $request->level,
            'duration' => $request->duration,
            'price' => $request->price,
            'sort' => $request->sort ?? 0,
            'skills' => $request->skills ?? '',
            'description' => $request->description ?? '',
            'status' => $status,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $courseData['image'] = '/uploads/courses/' . $filename;
        }

        $this->db->courses->insertOne($courseData);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function edit($id)
    {
        $course = $this->db->courses->findOne([
            '_id' => new ObjectId($id)
        ]);

        $categories = $this->db->categories
            ->find([], ['sort' => ['order' => 1]])
            ->toArray();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $status = $request->has('status') ? 'Active' : 'Inactive';

        $courseData = [
            'name' => $request->name,
            'category' => $request->category,
            'level' => $request->level,
            'duration' => $request->duration,
            'price' => $request->price,
            'sort' => $request->sort ?? 0,
            'skills' => $request->skills ?? '',
            'description' => $request->description ?? '',
            'status' => $status,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/courses'), $filename);
            $courseData['image'] = '/uploads/courses/' . $filename;
        }

        $this->db->courses->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $courseData]
        );

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $this->db->courses->deleteOne([
            '_id' => new ObjectId($id)
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully');
    }

    // ================= FRONTEND METHOD =================
  public function show($id)
{
    $course = $this->db->courses->findOne([
        '_id' => new \MongoDB\BSON\ObjectId($id)
    ]);

    if (!$course) {
        abort(404);
    }

    // Skills
    $skills = isset($course['skills'])
        ? array_map('trim', explode(',', $course['skills']))
        : [];

    // Topics (stored as string course_id)
    $topics = $this->db->topics
        ->find(['course_id' => (string) $id])
        ->toArray();

    // Upcoming trainings (IMPORTANT: use launch_dates collection)
    $upcomingTrainings = $this->db->launch_dates
        ->find([
            'course_id' => new \MongoDB\BSON\ObjectId($id),
            'launch_date' => ['$gte' => date('Y-m-d')]
        ], [
            'sort' => ['launch_date' => 1]
        ])
        ->toArray();

    return view('course-details', compact(
        'course',
        'skills',
        'topics',
        'upcomingTrainings'
    ));
}


}