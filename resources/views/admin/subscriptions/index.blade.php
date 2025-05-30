@extends('layouts.admin-flipbook')

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Student Subscriptions
    </h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.subscriptions.create') }}"
           class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
            + Add New Subscription
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
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
                @foreach ($subscriptions as $subscription)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_email }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->std_id }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->sub_start_date }}</td>
                        <td class="px-4 py-3 text-sm">{{ $subscription->sub_end_date }}</td>
                        <td class="px-4 py-3 text-sm">{{ number_format($subscription->sub_fee, 2) }}</td>
                        <td class="px-4 py-3 text-xs">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                {{ $subscription->status === 'on' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-600 bg-gray-200 dark:bg-gray-700 dark:text-gray-400' }}">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}"
                                   class="flex items-center justify-between px-2 py-2 text-sm font-medium text-purple-600 rounded-lg hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subscription?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
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
                @endforeach

                @if($subscriptions->isEmpty())
                    <tr>
                        <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">
                            No subscriptions found. <a href="{{ route('admin.subscriptions.create') }}" class="text-purple-600 hover:underline">Create one now</a>
                        </td>
                    </tr>
                @endif
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
                {{ $subscriptions->links() }}
            </span>
        </div>
    </div>
</div>
@endsection

