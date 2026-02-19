<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class CourseController extends Controller
{
    protected $coursesCollection;
    protected $categoriesCollection;
    protected $launchDatesCollection;

    public function __construct()
    {
        // MongoDB client initialize
        $client = new Client("mongodb://127.0.0.1:27017");
        $db = $client->btmg_trainings; // database name

        // Collections
        $this->coursesCollection = $db->courses;
        $this->categoriesCollection = $db->categories;
        $this->launchDatesCollection = $db->launch_dates;
    }

    // Frontend courses list – only active courses with future launch dates
    public function index()
    {
        // 1️⃣ Get today's date in Y-m-d format (same as stored in launch_dates)
        $today = date('Y-m-d');

        // 2️⃣ Find all launch dates that are today or in the future
        $futureLaunches = $this->launchDatesCollection->find(
            ['launch_date' => ['$gte' => $today]],
            ['projection' => ['course_id' => 1]]
        );

        // 3️⃣ Extract course IDs from these launches
        $courseIds = [];
        foreach ($futureLaunches as $launch) {
            $courseIds[] = $launch['course_id']; // ObjectId
        }

        // 4️⃣ Fetch active courses that have a future launch date
        $courses = [];
        if (!empty($courseIds)) {
            $courses = iterator_to_array(
                $this->coursesCollection->find([
                    '_id' => ['$in' => $courseIds],
                    'status' => 'Active'
                ])
            );
        }

        // 5️⃣ Get all categories (unchanged)
        $categoriesCursor = $this->categoriesCollection->find([], [
            'sort' => ['sort' => 1] // smallest order first
        ]);
        $categories = iterator_to_array($categoriesCursor);

        return view('courses', compact('courses', 'categories'));
    }

    // Single course details – only accessible if active and future launch date
    public function show($id)
    {
        // Ensure the course exists and is active
        $course = $this->coursesCollection->findOne([
            '_id' => new ObjectId($id),
            'status' => 'Active'
        ]);

        if (!$course) {
            abort(404);
        }

        // Verify that this course has a launch date >= today
        $today = date('Y-m-d');
        $launch = $this->launchDatesCollection->findOne([
            'course_id' => new ObjectId($id),
            'launch_date' => ['$gte' => $today]
        ]);

        if (!$launch) {
            abort(404);
        }

        return view('course-details', compact('course'));
    }
}