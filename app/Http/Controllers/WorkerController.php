<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class WorkerController extends Controller
{
    public function createWorker(Request $request):JsonResponse{
        

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:workers,email',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|string|max:500',
            'nid' => 'required|string|max:50|unique:workers,nid',
            'service_type' => 'required|string|max:255',
            'expertise_of_service' => 'required|string|max:255',
            'shift' => 'required|string|max:100',
            'rating' => 'nullable|numeric|min:0|max:5|between:0,5',
            'feedback' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'is_active' => 'sometimes|boolean'
        ]);
        $worker = Worker::create($validated);

        return response()->json([
            'success' => true,
            'data' => $worker,
            'message' => 'Worker created successfully'
        ], 201);

    }

    public function getAllWorkers(): JsonResponse
{
    $workers = Worker::all();
    
    return response()->json([
        'success' => true,
        'data' => $workers,
        'message' => 'Workers retrieved successfully'
    ]);
}
}
