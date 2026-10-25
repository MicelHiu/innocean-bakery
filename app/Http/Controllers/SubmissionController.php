<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Http\Resources\SubmissionResource;
use App\Http\Requests\StoreSubmissionRequest;

class SubmissionController extends Controller
{
    public function index()
    {
        return SubmissionResource::collection(
            Submission::with(['store', 'product'])->latest()->get()
        );
    }

    public function store(StoreSubmissionRequest $request)
    {
        $submission = Submission::create($request->validated());
        return new SubmissionResource(($submission->load(['store', 'product'])));
    }
}
