@extends('layouts.admin-flipbook')
<style>
.ti-download,.ti-sharethis {
    display: none !important;
}
</style>    

@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Ebooks
    </h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.ebooks.create') }}"
           class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors duration-200">
            + Add New Ebook
        </a>
    </div>

    <!-- Success/Error Messages -->
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
                        <!-- <th class="px-4 py-3">Cover</th> -->
                        <th class="px-4 py-3">Book</th>
                        <th class="px-4 py-3">Version</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($ebooks as $ebook)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $ebook->ebook_name }}
                            </td>
                            <!-- <td class="px-4 py-3">
                                @if($ebook->ebook_cover)
                                    <img src="{{ asset($ebook->ebook_cover) }}" class="w-12 h-12 rounded object-cover" alt="Cover" loading="lazy">
                                @else
                                    <span class="text-xs text-gray-400">No Cover</span>
                                @endif
                            </td> -->
                            <td class="px-4 py-3 text-sm">
                                @if($ebook->ebook_file)
                                  <div class="_df_thumb" source="{{ route('admin.ebooks.secure-pdf', $ebook->id) }}"
      thumb="{{ asset($ebook->ebook_cover) }}"></div>
                                @else
                                    <span class="text-xs text-gray-400">No File</span>
                                @endif
                            </td>
                            <!-- <td class="px-4 py-3 text-sm">
                                @if($ebook->ebook_file)
                                    <a href="{{ route('admin.ebooks.view', $ebook->id) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 hover:underline flex items-center"
                                       title="View in 3D Flipbook">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">No File</span>
                                @endif
                            </td> -->
                            <td class="px-4 py-3 text-sm">
                                {{ $ebook->ebook_ver }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                    {{ $ebook->status === 'on' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-600 bg-gray-200 dark:bg-gray-700 dark:text-gray-400' }}">
                                    {{ ucfirst($ebook->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('admin.ebooks.edit', $ebook->id) }}"
                                       class="flex items-center justify-between px-2 py-2 text-sm font-medium text-purple-600 rounded-lg hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                       aria-label="Edit"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.ebooks.destroy', $ebook->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ebook?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            aria-label="Delete"
                                            title="Delete">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($ebooks->isEmpty())
                        <tr>
                            <td colspan="6" class="px-4 py-3 text-center text-sm text-gray-500">
                                No ebooks found. <a href="{{ route('admin.ebooks.create') }}" class="text-purple-600 hover:underline">Create one now</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800 sm:grid-cols-9">
            <span class="flex items-center col-span-3">
                Showing {{ $ebooks->firstItem() }}-{{ $ebooks->lastItem() }} of {{ $ebooks->total() }}
            </span>
            <span class="col-span-4 sm:col-span-2"></span>
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                {{ $ebooks->links() }}
            </span>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('keydown', function(e) {
    // Detect Ctrl+P or Command+P
    if ((e.ctrlKey || e.metaKey) && e.keyCode === 80) {
        e.preventDefault();
        alert('Printing is disabled on this page.');
    }
});
</script>