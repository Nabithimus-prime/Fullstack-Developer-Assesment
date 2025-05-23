@extends('layouts.app')

@section('content')

{{-- new post & icons--}}
<div style="display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 30px 30px;
            color: rgb(112, 112, 112)">
    <h2 style="margin: 10;">
        New Post
    </h2>
    
    {{-- icons --}}
    <div>
        {{-- edit --}}
        <a href="#" 
        style= "margin-right: 15px; 
                color: gray;
                text-decoration: none;">
            <i class="fas fa-pen"></i>
        </a>
        {{-- delete --}}
        <a href="#" id="delete-icon" 
                    style="color: gray;">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>

{{-- data collection --}}
<form method="POST" 
        action="#" 
        enctype="multipart/form-data" 
        id="postForm" 
        style= "padding: 0 30px 30px; 
                display: flex; 
                flex-direction: column; 
                gap: 20px;">
    @csrf

    <!-- title -->
    <div class="form-row">
        <label for="title" class="form-label"> Title </label>
        <div class="form-field">
            <input type="text" id="title" name="title" placeholder="Title" class="input-box form-input" required>
        </div>
    </div>

    <!-- slug -->
    <div class="form-row">
        <label for="slug" class="form-label"> Slug </label>
        <div class="form-field">
            <input type="text" id="slug" name="slug" placeholder="Slug" class="input-box form-input" required>
        </div>
    </div>

    <!-- content -->
    <div class="form-row">
        <label for="content" class="form-label"> Content </label>
        <div class="form-field">
          <textarea id="content" name="content" placeholder="Start writing here..." rows="6" class="input-box form-input" required></textarea>
        </div>
    </div>

    <!-- excerpt -->
    <div class="form-row">
        <label for="excerpt" class="form-label"> Excerpt </label>
        <div class="form-field">
            <textarea id="excerpt" name="excerpt" placeholder="Start writing here..." rows="3" class="input-box form-input"></textarea>
        </div>
    </div>

    <!-- featured image -->
    <div class="form-row">
        <label for="featured_image" class="form-label"> Featured Image </label>
        <div class="form-input">
            <button type="button" onclick="document.getElementById('featured_image').click()" class="btn-orange" style="align-items:left">
                <i class="fas fa-upload"></i> 
                Select Image
            </button>
            <input type="file" id="featured_image" name="featured_image" accept="image/*" style="display:none;">
        </div>
    </div>

    <!-- published date -->
    <div class="form-row">
        <label for="published_date" class="form-label"> Publish Date </label>
        <div class="form-field">
            <input type="date" id="published_date" name="published_date" class="input-box form-input">
        </div>
    </div>
</form>

@endsection