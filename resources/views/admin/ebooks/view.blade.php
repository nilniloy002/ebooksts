@extends('layouts.admin-flipbook')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">{{ $ebook->ebook_name }} (v{{ $ebook->ebook_ver }})</h2>
        <a href="{{ route('admin.ebooks.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
            Back to List
        </a>
    </div>
    
    <div class="bg-white p-4 rounded-lg shadow">
        <div id="flipbook-container">
            <div class="_df_book" 
                 source="{{ route('admin.ebooks.secure-pdf', $ebook->id) }}" 
                 viewmode="3D"
                 toolbar="true"
                 download="false">
            </div>
        </div>
    </div>
</div>

@endsection

