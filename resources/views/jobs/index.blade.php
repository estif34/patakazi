<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('jobs.index') }}" method="GET">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div class="col-span-1 sm:col-span-2 lg:col-span-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" 
                                   id="search"
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Job title or keyword..." 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Category -->
                        <div class="col-span-1">
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select id="category" 
                                    name="category" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Location -->
                        <div class="col-span-1">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" 
                                   id="location"
                                   name="location" 
                                   value="{{ request('location') }}"
                                   placeholder="City, state, or remote" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-span-1 sm:col-span-2 lg:col-span-1 flex items-end gap-2">
                            <button type="submit" 
                                    class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Filter Jobs
                            </button>
                            @if(request()->anyFilled(['search', 'category', 'location']))
                                <a href="{{ route('jobs.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <div class="space-y-6">
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
                                {{ Str::limit( $job->description , 200) }}
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
            </div>

            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>