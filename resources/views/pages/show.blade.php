@extends('layouts.app')

@section('content')

{{-- title, date & icons --}}
<div style="display: flex;
            padding: 30px 30px 0px 30px;
            height: auto;   
            justify-content: space-between; 
            align-items: center; 
            color: rgb(112, 112, 112);">
    <div>
        <h2 style="margin: 10px;">
            {{ $post->title }}
        </h2>
        <p style="margin: 0; font-size: 12px; color: rgb(150, 150, 150);">
            Published on {{ \Carbon\Carbon::parse($post->published_date)->format('F j, Y') }}
        </p>

        {{-- edit & delete --}}
    </div>
    <div style="position: flex;
                margin: 10px; 
                right: 25px; 
                font-size: 14px;">

        <a href="#" class="edit-icon" data-post-id="{{ $post['id'] }}" style="text-decoration: none;">
            <i class= "fas fa-pen" 
                style= "margin-right: clamp(10px, 3vw, 15px); 
                        color: rgb(116, 116, 116);">
            </i>
        </a>
        
        <a href="#" class="delete-icon" data-post-id="{{ $post['id'] }}">
            <i class="fas fa-trash" 
                style="color: rgb(116, 116, 116);">
            </i>
        </a>
    </div>
</div>

{{-- image  --}}
<div style="padding: 30px 30px 0 30px;">
    <img src="{{ asset('storage/' . $post['featured_image']) }}" 
         alt="Image for {{ $post->title }}" 
         style="max-width: 100%; height: auto;">
</div>

{{-- content  --}}
<div style="margin:20px 80px 0 80px;">
    <p style= "font-size: 12px; 
                color: rgb(112, 112, 112);
                text-align: center;
                margin-top:0px;">
        {{ $post->content }}
    </p>
</div>

{{-- back to home button  --}}
<div style="text-align: right; margin-top: 15px;">
    <a href="{{ url('/') }}" 
        class="btn-orange" 
        style= "padding: 10px 25px; 
                margin:15px;
                font-size: 14px; 
                text-decoration: none;">
        Go Back
    </a>
</div>

@endsection
