{{-- resources/views/livewire/job-filter.blade.php --}}
<div>
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Available Jobs</h2>
            @auth
                <a href="{{ route('jobs.create') }}" class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Post a Job
                </a>
            @else
                <a href="{{ route('register') }}" class="w-full md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Post a Job
                </a>
            @endauth
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="col-span-1 md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search jobs or locations</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" 
                           id="search"
                           wire:model.live.debounce.300ms="search" 
                           placeholder="Job title, keyword, or location..." 
                           class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            <!-- Category -->
            <div class="col-span-1">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="category" 
                        wire:model.live="category" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Clear Filters -->
            @if($search || $category)
                <div class="col-span-1 md:col-span-3 flex justify-end">
                    <button wire:click="clearFilters" 
                            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear filters
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Loading indicator -->
    <div wire:loading class="flex justify-center my-6">
        <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
    </div>

    <!-- Jobs list -->
    <div wire:loading.remove class="space-y-6">
        @if($jobs->count() > 0)
            @foreach ($jobs as $job)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $job->title }}
                                </h3>
                                <p class="text-gray-600">{{ $job->company_name }}</p>
                            </div>
                            <span class="text-gray-600">{{ $job->location }}</span>
                        </div>
                        
                        <p class="mt-4 text-gray-600">
                            {{ Str::limit($job->description, 200) }}
                        </p>
                        
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-gray-600">{{ $job->salary_range }}</span>
                            <a href="{{ route('jobs.show', $job) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <p class="text-gray-600">No jobs found matching your criteria.</p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>