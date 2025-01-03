<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
                        <div class="mt-2">
                            <span class="text-gray-600">{{ $job->company_name }}</span>
                            <span class="text-gray-400 mx-2">|</span>
                            <span class="text-gray-600">{{ $job->location }}</span>
                        </div>
                        <div class="mt-1">
                            <span class="text-blue-600 font-semibold">{{ $job->salary_range }}</span>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Job Description</h2>
                        <div class="text-gray-600 space-y-4">
                            {!! nl2br(e($job->description)) !!}
                        </div>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Requirements</h2>
                        <div class="text-gray-600 space-y-4">
                            {!! nl2br(e($job->requirements)) !!}
                        </div>
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <p class="text-gray-600">Posted by {{ $job->user->name }} on {{ $job->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('jobs.index') }}" 
                           class="text-blue-500 hover:text-blue-700">
                            ← Back to Jobs
                        </a>
                        
                        @auth
                        @if(auth()->user()->id === $job->user_id)
                            <div class="flex space-x-4">
                                <a href="{{ route('jobs.edit', $job) }}" 
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Edit Job
                                </a>
                                <form action="{{ route('jobs.toggle-status', $job) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="{{ $job->status === 'active' ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }} text-white font-bold py-2 px-4 rounded"
                                            onclick="return confirm('Are you sure you want to {{ $job->status === 'active' ? 'deactivate' : 'reactivate' }} this job post?')">
                                        {{ $job->status === 'active' ? 'Deactivate' : 'Reactivate' }} Job
                                    </button>
                                </form>
                            </div>

                            <div class="mt-4">
                                <span class="{{ $job->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                    Status: {{ ucfirst($job->status) }}
                                </span>
                            </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>