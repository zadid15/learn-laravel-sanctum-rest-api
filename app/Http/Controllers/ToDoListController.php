<?php

namespace App\Http\Controllers;

use App\Http\Resources\ToDoListResource;
use App\Models\ToDoList;
use Exception;
use Illuminate\Http\Request;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $todolist = ToDoList::latest()->get();

        return ToDoListResource::collection($todolist);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|boolean'
        ]);

        try {
            $todolist = ToDoList::create($data);

            return response()->json([
                'message' => 'ToDoList created successfully',
                'data' => new ToDoListResource($todolist)
            ], 201);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Failed to create ToDoList'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $todolist = ToDoList::find($id);

        if (!$todolist) {
            return response()->json([
                'message' => 'ToDoList not found'
            ], 404);
        }

        return new ToDoListResource($todolist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|boolean'
        ]);

        $todolist = ToDoList::find($id);

        if (!$todolist) {
            return response()->json([
                'message' => 'ToDoList not found'
            ], 404);
        }

        try {
            $todolist->update($data);

            return response()->json([
                'message' => 'ToDoList updated successfully',
                'data' => new ToDoListResource($todolist)
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Failed to update ToDoList'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $todolist = ToDoList::find($id);

        if (!$todolist) {
            return response()->json([
                'message' => 'ToDoList not found'
            ], 404);
        }

        try {
            $todolist->delete();

            return response()->json([
                'message' => 'ToDoList deleted successfully'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'Failed to delete ToDoList'
            ], 500);
        }
    }
}
