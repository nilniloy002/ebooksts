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
            <div class="df-flipbook" 
                 source="{{ route('admin.ebooks.secure-pdf', $ebook->id) }}" 
                 viewmode="3D"
                 toolbar="true"
                 download="false">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.df-flipbook').dearflip({
            webgl: true,
            backgroundColor: "#f8fafc",
            template: {
                html: 'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/html.html',
                styles: [
                    'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/css/style.css',
                    'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/css/themebasic.min.css'
                ],
                scripts: [
                    'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/js/script.js'
                ],
                sounds: {
                    start: 'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/sounds/start.mp3',
                    end: 'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/sounds/end.mp3',
                    flip: 'https://cdn.jsdelivr.net/npm/dearflip@3.1.0/dist/templates/default/sounds/flip.mp3',
                }
            },
            events: {
                onFlip: function(e) {
                    console.log('Page flipped to', e.page);
                },
                onReady: function() {
                    console.log('Flipbook is ready');
                }
            }
        });
    });
</script>
@endsection

