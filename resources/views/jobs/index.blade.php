<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Available Jobs</h2>
                <div class="mb-6">
                    <form action="{{ route('jobs.index') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <input type="text" name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Search jobs..." 
                                    class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Category -->
                            <div>
                                <select name="category" class="w-full shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Location -->
                            <div>
                                <input type="text" name="location" 
                                    value="{{ request('location') }}"
                                    placeholder="Location" 
                                    class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filter
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
                <div class="mb-6">
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex gap-4">
                        <input type="text" name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search jobs..." 
                            class="flex-1 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="submit" 
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('jobs.index') }}" 
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
                @auth
                    <a href="{{ route('jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Post a Job
                    </a>
                @endauth
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
            </div>

            <div class="mt-6">
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>