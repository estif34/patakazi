<?php
// app/Livewire/JobFilter.php

namespace App\Livewire;

use App\Models\Job;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class JobFilter extends Component
{
    use WithPagination;
    
    // Filter properties
    public $search = '';
    public $category = '';
    
    // When filter properties change, reset pagination to page 1
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategory()
    {
        $this->resetPage();
    }
    
    // Clear all filters
    public function clearFilters()
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }
    
    // Get filtered jobs
    public function getJobsProperty()
    {
        return Job::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('company_name', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('category_id', $this->category);
            })
            ->where('status', 'active')
            ->orderByDesc('created_at')
            ->paginate(10);
    }
    
    // Render the component
    public function render()
    {
        return view('livewire.job-filter', [
            'jobs' => $this->jobs,
            'categories' => Category::all(),
        ]);
    }
}