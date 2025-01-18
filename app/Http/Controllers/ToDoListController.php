<?php

namespace App\Http\Controllers;

use App\Http\Resources\ToDoListResource;
use App\Models\Logging;
use App\Models\ToDoList;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ToDoListController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $todolists = ToDoList::latest()->where('user_id', auth()->user()->id)->get();

            return ToDoListResource::collection($todolists);
        } catch (Exception $error) {
            Log::error('Failed to get ToDoLists, ' . $error->getMessage());

            Logging::record(auth()->user()->id, request()->fullUrl(), 'Failed to get ToDoLists, ' . $error->getMessage(), request()->ip());

            return response()->json([
                'message' => 'Failed to get ToDoLists, ' . $error->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', ToDoList::class);

        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|boolean'
        ]);

        try {
            $data['user_id'] = auth()->user()->id;
            $todolist = ToDoList::create($data);

            return response()->json([
                'message' => 'ToDoList created successfully',
                'data' => new ToDoListResource($todolist)
            ], 201);
        } catch (Exception $error) {
            Log::error('Failed to create ToDoList, ' . $error->getMessage());

            Logging::record(auth()->user()->id, request()->fullUrl(), 'Failed to create ToDoList, ' . $error->getMessage(), request()->ip());

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
        try {
            $todolist = ToDoList::find($id);

            $this->authorize('view', $todolist);

            return new ToDoListResource($todolist);
        } catch (Exception $error) {
            Log::error('Failed to get specific ToDoList, ' . $error->getMessage());

            Logging::record(auth()->user(), request()->fullUrl(), 'Failed to get specific ToDoList, ' . $error->getMessage(), request()->ip());

            return response()->json([
                'message' => 'Failed to get specific ToDoList, ' . $error->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $todolist = ToDoList::find($id);

        if (!$todolist) {
            return response()->json([
                'message' => 'ToDoList not found'
            ]);
        }
        
        $this->authorize('update', $todolist);
        
        $data = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'is_done' => 'required|boolean'
        ]);
        
        
        try {
            $todolist->update($data);

            return response()->json([
                'message' => 'ToDoList updated successfully',
                'data' => new ToDoListResource($todolist)
            ], 200);
        } catch (Exception $error) {
            Log::error('Failed to update ToDoList, ' . $error->getMessage());

            Logging::record(auth()->user()->id, request()->fullUrl(), 'Failed to update ToDoList, ' . $error->getMessage(), request()->ip());

            return response()->json([
                'message' => 'Failed to update ToDoList, ' . $error->getMessage()
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
            ]);
        }

        $this->authorize('delete', $todolist);

        try {
            $todolist->delete();

            return response()->json([
                'message' => 'ToDoList deleted successfully'
            ], 200);
        } catch (Exception $error) {
            Log::error('Failed to delete ToDoList, ' . $error->getMessage());

            Logging::record(auth()->user()->id, request()->fullUrl(), 'Failed to delete ToDoList, ' . $error->getMessage(), request()->ip());

            return response()->json([
                'message' => 'Failed to delete ToDoList, ' . $error->getMessage()
            ], 500);
        }
    }
}
