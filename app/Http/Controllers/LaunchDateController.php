<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use Carbon\Carbon;

class LaunchDateController extends Controller
{
    protected $db;

    public function __construct()
    {
        $client = new Client("mongodb://127.0.0.1:27017");
        $this->db = $client->btmg_trainings;
    }

    // -------------------- INDEX --------------------
    // -------------------- INDEX --------------------
public function index()
{
    $launchDatesCursor = $this->db->launch_dates->find([], ['sort' => ['launch_date' => 1]]);
    $launchDates = [];

    foreach ($launchDatesCursor as $launch) {
        $launchArray = json_decode(json_encode($launch), true);

        // Convert _id safely
        $launchArray['_id'] = $this->getObjectIdString($launchArray['_id'] ?? '');

        // Convert launch_date safely
        $launchArray['launch_date'] = $this->parseLaunchDate($launchArray['launch_date'] ?? null);

        $launchDates[] = $launchArray;
    }

    return view('admin.launch-dates.index', compact('launchDates'));
}

// -------------------- CREATE --------------------
public function create()
{
    $allCourses = $this->db->courses->find()->toArray(); // show all courses
    return view('admin.launch-dates.create', compact('allCourses'));
}

// -------------------- STORE --------------------
public function store(Request $request)
{
    $request->validate([
        'course_id' => 'required',
        'launch_date' => 'required|date'
    ]);

    $course = $this->db->courses->findOne(['_id' => new ObjectId($request->course_id)]);

    if ($course) {
        $this->db->launch_dates->insertOne([
            'course_id' => $course['_id'],
            'course_name' => $course['name'],
            'level' => $course['level'] ?? '-',
            'launch_date' => $request->launch_date,
            'enrollments' => 0,
            'inquiries' => 0,
        ]);
    }

    return redirect()->route('admin.launch-dates.index')->with('success', 'Launch Date Added');
}

// -------------------- EDIT --------------------
public function edit($id)
{
    $launch = $this->db->launch_dates->findOne(['_id' => new ObjectId($id)]);
    if (!$launch) {
        return redirect()->route('admin.launch-dates.index')->with('error', 'Launch date not found');
    }

    $launchArray = json_decode(json_encode($launch), true);
    $launchArray['_id'] = $this->getObjectIdString($launchArray['_id'] ?? '');
    $launchArray['launch_date'] = $this->parseLaunchDate($launchArray['launch_date'] ?? null);

    $allCourses = $this->db->courses->find()->toArray(); // show all courses

    return view('admin.launch-dates.edit', compact('launchArray', 'allCourses'));
}

// -------------------- UPDATE --------------------
public function update(Request $request, $id)
{
    $request->validate([
        'course_id' => 'required',
        'launch_date' => 'required|date'
    ]);

    $course = $this->db->courses->findOne(['_id' => new ObjectId($request->course_id)]);
    if ($course) {
        $this->db->launch_dates->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'course_id' => $course['_id'],
                'course_name' => $course['name'],
                'level' => $course['level'] ?? '-',
                'launch_date' => $request->launch_date
            ]]
        );
    }

    return redirect()->route('admin.launch-dates.index')->with('success', 'Launch Date Updated');
}

// -------------------- DESTROY --------------------
public function destroy($id)
{
    $this->db->launch_dates->deleteOne(['_id' => new ObjectId($id)]);
    return redirect()->route('admin.launch-dates.index')->with('success', 'Launch Date Deleted');
}
// -------------------- HELPER FUNCTIONS --------------------

// Safely convert ObjectId to string
private function getObjectIdString($id)
{
    if (is_array($id) && isset($id['$oid'])) {
        return (string)$id['$oid'];
    } elseif ($id instanceof \MongoDB\BSON\ObjectId) {
        return (string)$id;
    } elseif (is_string($id)) {
        return $id;
    }
    return '';
}

// Safely parse MongoDB date
private function parseLaunchDate($date)
{
    if ($date instanceof \MongoDB\BSON\UTCDateTime) {
        return $date->toDateTime()->format('Y-m-d');
    } elseif (is_array($date) && isset($date['$date'])) {
        return \Carbon\Carbon::parse($date['$date'])->format('Y-m-d');
    } elseif (is_string($date) || is_numeric($date)) {
        return (string)$date;
    } else {
        return '';
    }
}

}
