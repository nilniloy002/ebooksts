@extends('layouts.admin')

@section('content')
<div class="container px-6 mx-auto grid">
  <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    {{ $subscription->exists ? 'Edit Subscription' : 'Add Subscription' }}
  </h2>

  <form 
    action="{{ $subscription->exists ? route('admin.subscriptions.update', $subscription) : route('admin.subscriptions.store') }}" 
    method="POST"
    class="space-y-4 bg-white rounded-lg shadow-md dark:bg-gray-800 p-6"
  >
    @csrf
    @if($subscription->exists)
      @method('PUT')
    @endif

    <!-- Name -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Student Name</span>
      <input
        type="text"
        name="std_name"
        value="{{ old('std_name', $subscription->std_name) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
        placeholder="Enter student name"
      />
    </label>

    <!-- Email -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Student Email</span>
      <input
        type="email"
        name="std_email"
        value="{{ old('std_email', $subscription->std_email) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
        placeholder="Enter student email"
      />
    </label>

    <!-- Student ID -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Student ID</span>
      <input
        type="text"
        name="std_id"
        value="{{ old('std_id', $subscription->std_id) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
        placeholder="Enter student ID"
      />
    </label>

    <!-- Password (optional) -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Password</span>
      <input
        type="password"
        name="password"
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
        placeholder="Enter new password (leave blank to keep current)"
      />
      @if(isset($subscription))
        <p class="text-xs text-gray-500 mt-1">Leave blank to keep existing password.</p>
      @endif
    </label>


    <!-- Subscription Start Date -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Subscription Start Date</span>
      <input
        type="date"
        name="sub_start_date"
        value="{{ old('sub_start_date', $subscription->sub_start_date) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
      />
    </label>

    <!-- Subscription End Date -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Subscription End Date</span>
      <input
        type="date"
        name="sub_end_date"
        value="{{ old('sub_end_date', $subscription->sub_end_date) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
      />
    </label>

    <!-- Subscription Fee -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Subscription Fee</span>
      <input
        type="number"
        step="0.01"
        name="sub_fee"
        value="{{ old('sub_fee', $subscription->sub_fee) }}"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-input"
        placeholder="Enter subscription fee"
      />
    </label>

    <!-- Status -->
    <label class="block text-sm">
      <span class="text-gray-700 dark:text-gray-400">Status</span>
      <select
        name="status"
        required
        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 form-select"
      >
        <option value="on" {{ old('status', $subscription->status) == 'on' ? 'selected' : '' }}>On</option>
        <option value="off" {{ old('status', $subscription->status) == 'off' ? 'selected' : '' }}>Off</option>
      </select>
    </label>

    <!-- Submit Button -->
    <button
      type="submit"
      class="mt-6 px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700"
    >
      {{ $subscription->exists ? 'Update Subscription' : 'Add Subscription' }}
    </button>
  </form>
</div>
@endsection
