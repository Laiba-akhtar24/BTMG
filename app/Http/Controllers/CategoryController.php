<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use MongoDB\BSON\ObjectId;

class CategoryController extends Controller
{
    protected $collection;

    public function __construct()
    {
        // Direct MongoDB Connection (NO app('mongodb'))
        $client = new Client("mongodb://127.0.0.1:27017");
        $database = $client->btmg_trainings; // <-- apna database name
        $this->collection = $database->categories;
    }

    // ================= INDEX =================
    public function index()
    {
        $categoriesCursor = $this->collection->find(
            [],
            ['sort' => ['order' => 1]] // smallest first
        );

        $categories = iterator_to_array($categoriesCursor);

        foreach ($categories as &$cat) {
            $cat['_id'] = (string) $cat['_id'];
            $cat['order'] = $cat['order'] ?? 0;
        }

        return view('admin.categories.index', compact('categories'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.categories.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'order' => 'required|integer|min:1'
        ]);

       $this->collection->insertOne([
    'name' => $request->name,
    'slug' => $request->slug,
    'order' => (int) $request->order,
]);


        return redirect()->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $category = $this->collection->findOne([
            '_id' => new ObjectId($id)
        ]);

        $category['_id'] = (string) $category['_id'];

        return view('admin.categories.edit', compact('category'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'order' => 'required|integer|min:1'
        ]);

        $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
    'name' => $request->name,
    'slug' => $request->slug,
    'order' => (int) $request->order,
]
            ]
        );

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $this->collection->deleteOne([
            '_id' => new ObjectId($id)
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
