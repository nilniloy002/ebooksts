@extends('layouts.admin')

@section('content')
<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    {{ $ebook->exists ? 'Edit Ebook' : 'Add Ebook' }}
  </h2>

  <form 
    action="{{ $ebook->exists ? route('admin.ebooks.update', $ebook->id) : route('admin.ebooks.store') }}" 
    method="POST" 
    enctype="multipart/form-data"
  >
    @csrf
    @if($ebook->exists)
      @method('PUT')
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
      
      <!-- Ebook Name -->
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Ebook Name</span>
        <input
          type="text"
          name="ebook_name"
          value="{{ old('ebook_name', $ebook->ebook_name) }}"
          required
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
          placeholder="Enter ebook name"
        />
      </label>

      <!-- Ebook Version -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Ebook Version</span>
        <select
          name="ebook_ver"
          required
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
        >
          @foreach(['1.0','2.0','3.0','4.0','5.0'] as $ver)
            <option value="{{ $ver }}" {{ old('ebook_ver', $ebook->ebook_ver) == $ver ? 'selected' : '' }}>
              {{ $ver }}
            </option>
          @endforeach
        </select>
      </label>

      <!-- Status -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Status</span>
        <select
          name="status"
          required
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple"
        >
          <option value="on" {{ old('status', $ebook->status) == 'on' ? 'selected' : '' }}>On</option>
          <option value="off" {{ old('status', $ebook->status) == 'off' ? 'selected' : '' }}>Off</option>
        </select>
      </label>

      <!-- Ebook File -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Ebook File (PDF)</span>
        <input
          type="file"
          name="ebook_file"
          {{ $ebook->exists ? '' : 'required' }}
          class="block w-full mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input"
        />
        @if($ebook->ebook_file)
          <a href="{{ asset($ebook->ebook_file) }}" target="_blank" class="text-sm text-blue-500 underline mt-1 inline-block">View Current File</a>
        @endif
      </label>

      <!-- Ebook Cover -->
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">Ebook Cover (Optional)</span>
        <input
          type="file"
          name="ebook_cover"
          class="block w-full mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-input"
        />
        @if(!empty($ebook->ebook_cover))
          <img src="{{ asset($ebook->ebook_cover) }}" class="h-24 mt-2" alt="Ebook Cover" />
        @endif
      </label>

      <!-- Submit -->
      <button
        type="submit"
        class="mt-6 px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700"
      >
        {{ $ebook->exists ? 'Update Ebook' : 'Add Ebook' }}
      </button>
    </div>
  </form>
</div>
@endsection
