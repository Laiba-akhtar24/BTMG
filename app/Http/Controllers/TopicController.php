<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client; // MongoDB client
use MongoDB\BSON\ObjectId;

class TopicController extends Controller
{
    protected $db;

    public function __construct()
    {
        // MongoDB connection
        $client = new Client('mongodb://127.0.0.1:27017');
        $this->db = $client->btmg_trainings;
    }

    // Show topics page for a course
    public function showTopics($courseId)
    {
        $course = $this->db->courses->findOne(['_id' => new ObjectId($courseId)]);

        $topics = $this->db->topics
            ->find(['course_id' => (string)$courseId])
            ->toArray();

        return view('admin.courses.topics', [
            'courseId' => (string)$courseId,
            'courseName' => $course['name'] ?? 'Course',
            'topics' => $topics
        ]);
    }

    // Store new topic
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort' => 'nullable|integer',
            'status' => 'nullable'
        ]);

        $status = $request->has('status') ? 'Active' : 'Inactive';

        $topicData = [
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description ?? '',
            'sort' => $request->sort ?? 0,
            'status' => $status
        ];

        $this->db->topics->insertOne($topicData);

        return back()->with('success', 'Topic added successfully.');
    }

    // Show edit form for a topic
    public function edit($id)
    {
        $topic = $this->db->topics->findOne(['_id' => new ObjectId($id)]);

        $course = $this->db->courses->findOne(['_id' => new ObjectId($topic['course_id'])]);

        return view('admin.courses.edit-topic', compact('topic', 'course'));
    }

    // Update topic
    public function update(Request $request, $id)
    {
        $topicData = [
            'title' => $request->title,
            'description' => $request->description ?? '',
            'sort' => $request->sort ?? 0,
            'status' => $request->has('status') ? 'Active' : 'Inactive',
        ];

        // Use the existing $db connection from constructor
        $this->db->topics->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => $topicData]
        );

        // Fetch updated topic
        $updatedTopic = $this->db->topics->findOne(['_id' => new ObjectId($id)]);

        return redirect()
            ->route('admin.courses.topics', $updatedTopic['course_id'])
            ->with('success', 'Topic updated successfully.');
    }

    // Delete topic
    public function destroy($id)
    {
        $topic = $this->db->topics->findOne(['_id' => new ObjectId($id)]);
        if (!$topic) {
            return back()->with('error', 'Topic not found.');
        }

        $courseId = $topic['course_id'];

        $this->db->topics->deleteOne(['_id' => new ObjectId($id)]);

        return redirect()->route('admin.courses.topics', $courseId)
                         ->with('success', 'Topic deleted successfully.');
    }
}
