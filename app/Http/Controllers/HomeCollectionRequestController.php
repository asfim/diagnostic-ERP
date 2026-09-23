<?php

namespace App\Http\Controllers;

use App\Models\HomeCollectionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeCollectionRequestController extends Controller
{
    public function index(): View
    {
        $requests = HomeCollectionRequest::latest()->paginate(15);

        return view('home-collection-requests.index', compact('requests'));
    }

    public function show(HomeCollectionRequest $home_collection_request): View
    {
        return view('home-collection-requests.show', ['requestItem' => $home_collection_request]);
    }

    public function updateStatus(Request $request, HomeCollectionRequest $home_collection_request): JsonResponse
    {
        $validated = $request->validate(['status' => ['required', 'in:pending,confirmed,out_for_delivery,delivered']]);
        $home_collection_request->update($validated);

        return response()->json(['message' => 'Status updated successfully.', 'status' => $home_collection_request->status]);
    }
}
