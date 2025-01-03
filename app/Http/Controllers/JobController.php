<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Category;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::query()->where('status', 'active');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('company_name', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        if ($request->filled('salary_min')) {
            $query->where('salary_range', '>=', $request->salary_min);
        }

        $jobs = $query->with(['user', 'category'])
                  ->latest()
                  ->paginate(10)
                  ->withQueryString();

        $categories = Category::all();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'company_name' => 'required|max:255',
            'location' => 'required|max:255',
            'salary_range' => 'required|max:255',
            'requirements' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        auth()->user()->jobs()->create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'company_name' => 'required|max:255',
            'location' => 'required|max:255',
            'salary_range' => 'required|max:255',
            'requirements' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $job->update($validated);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }
    
        $job->update(['status' => 'inactive']);

        return redirect()->route('jobs.index')
            ->with('success', 'Job has been deactivated successfully.');
    }

    public function toggleStatus(Job $job)
    {
        if ($job->user_id !== auth()->id()) {
            abort(403);
        }

        $newStatus = $job->status === 'active' ? 'inactive' : 'active';
        $job->update(['status' => $newStatus]);

        return redirect()->route('jobs.show', $job)
            ->with('success', "Job has been {$newStatus}d successfully.");
    }
}
