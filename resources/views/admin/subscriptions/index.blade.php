@extends('layouts.admin-flipbook')

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Student Subscriptions
    </h2>

    <div class="flex flex-col md:flex-row justify-between mb-4 gap-4">
        <div class="w-full md:w-1/3">
            <form action="{{ route('admin.subscriptions.index') }}" method="GET">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 dark:text-white" 
                        placeholder="Search by email..."
                    >
                    @if(request('search'))
                        <a href="{{ route('admin.subscriptions.index') }}" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>
        
        <a href="{{ route('admin.subscriptions.create') }}"
           class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200 whitespace-nowrap">
            + Add New Subscription
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded dark:bg-green-800 dark:border-green-600 dark:text-green-100">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded dark:bg-red-800 dark:border-red-600 dark:text-red-100">
            {{ session('error') }}
        </div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Student ID</th>
                    <th class="px-4 py-3">Subscription Start</th>
                    <th class="px-4 py-3">Subscription End</th>
                    <th class="px-4 py-3">Fee</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($subscriptions as $subscription)
                    <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_email }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_id }}</td>
                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($subscription->sub_start_date)->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-sm">{{ \Carbon\Carbon::parse($subscription->sub_end_date)->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-sm">${{ number_format($subscription->sub_fee, 2) }}</td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                {{ $subscription->status === 'on' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-600 bg-gray-200 dark:bg-gray-700 dark:text-gray-400' }}">
                                {{ $subscription->status === 'on' ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium text-purple-600 rounded-lg hover:bg-purple-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subscription?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            title="Delete">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500 dark:text-gray-400">
                            @if(request('search'))
                                No subscriptions found matching your search criteria.
                            @else
                                No subscriptions found. <a href="{{ route('admin.subscriptions.create') }}" class="text-purple-600 hover:underline">Create one now</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 sm:grid-cols-9">
            <span class="flex items-center col-span-3">
                Showing {{ $subscriptions->firstItem() }}-{{ $subscriptions->lastItem() }} of {{ $subscriptions->total() }}
            </span>
            <span class="col-span-4 sm:col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                {{ $subscriptions->appends(['search' => request('search')])->links() }}
            </span>
        </div>
    </div>
</div>
@endsection