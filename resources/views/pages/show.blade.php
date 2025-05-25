@extends('layouts.app')

@section('content')

{{-- title, date & icons --}}
<div class="page-header" style="padding: 30px 50px;">
        <div>
            <h2 style="margin: 10px 0;">
                {{ $post->title }}
            </h2>
            <p style="margin: 0; font-size: 12px; color: rgb(150, 150, 150);">
                Published on {{ \Carbon\Carbon::parse($post->published_date)->format('F j, Y') }}
            </p>
        </div>


    {{-- edit & delete --}}
    <div class="icon-area">
        <a href="#" class="icon-button edit-icon" data-post-id="{{ $post->id }}">
            <i class="fas fa-pen"></i>
        </a>
        <a href="#" class="icon-button delete-icon" data-post-id="{{ $post->id }}">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>

{{-- image  --}}
<div style="padding: 0px 50px;">
    <img src="{{ asset('storage/' . $post['featured_image']) }}" 
         alt="Image for {{ $post->title }}" 
         style="max-width: 100%; height: auto;">
</div>

{{-- content  --}}
<div style="margin:20px 80px 0;">
    <p style="font-size: 12px; color: rgb(112, 112, 112); text-align: center;">
            {{ $post->content }}
        </p>
</div>

{{-- back button  --}}
<div style="text-align: right; margin-top: 15px;">
    <a href="{{ url('/') }}" class="btn-orange" style="margin: 15px;">
        Go Back
    </a>
</div>

@endsection
