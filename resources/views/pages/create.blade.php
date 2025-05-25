@extends('layouts.app')

@section('content')

{{-- new post --}}
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
        <a href="#" onclick="openModal('delete')" class="delete-icon"  
                    style="color: gray;">
            <i class="fas fa-trash"></i>
        </a>
    </div>
</div>


{{-- data collection --}}
<form method="POST" 
        action="{{ route('posts.store') }}" 
        enctype="multipart/form-data" 
        id="createPostForm" 
        style= "padding: 0 30px 30px; 
                display: flex; 
                flex-direction: column; 
                gap: 20px;">
    @csrf

    @if(isset($post))
        <!-- Hidden input to hold old post id for deletion -->
        <input type="hidden" name="old_post_id" value="{{ $post->id }}">
    @endif
    
    <!-- title -->
    <div class="form-row">
        <label for="title" class="form-label"> Title </label>
        <div class="form-field">
            <input type="text" id="title" name="title" placeholder="Title" class="input-box form-input" required
                    value="{{ old('title', $post->title ?? '') }}">
        </div>
    </div>

    <!-- slug -->
    <div class="form-row">
        <label for="slug" class="form-label"> Slug </label>
        <div class="form-field">
            <input type="text" id="slug" name="slug" placeholder="Slug" class="input-box form-input" required
                    value="{{ old('slug', $post->slug ?? '') }}">
        </div>
    </div>

    <!-- content -->
    <div class="form-row">
        <label for="content" class="form-label"> Content </label>
        <div class="form-field">
         <textarea id="content" name="content" placeholder="Start writing here..." rows="10" class="input-box form-input" required>{{ old('content', isset($post) ? trim($post->content) : '') }}</textarea>
        </div>
    </div>

    <!-- excerpt -->
    <div class="form-row">
        <label for="excerpt" class="form-label"> Excerpt </label>
        <div class="form-field">
            <textarea id="excerpt" name="excerpt" placeholder="Start writing here..." rows="6" class="input-box form-input">{{ old('excerpt', isset($post) ? trim($post->excerpt) : '') }}</textarea>
        </div>
    </div>

    <!-- featured image -->
    <div class="form-row">
        <label for="featured_image" class="form-label"> Featured Image </label>
        <div class="form-field">
            <button type="button" onclick="document.getElementById('featured_image').click()" class="btn-orange">
                Select Image
               <i class="fas fa-upload"></i>
            </button>
            <input type="file" id="featured_image" name="featured_image" accept="image/*" style="display:none;">
            {{-- Show current image when editing --}}
            @if(isset($post) && $post->featured_image)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current Image" style="max-width: 150px;">
                </div>
            @endif
        </div>
    </div>

    <!-- published date -->
    <div class="form-row">
        <label for="published_date" class="form-label"> Publish Date </label>
        <div class="form-field">
            <input type="text" id="published_date" name="published_date" class="input-box form-input" placeholder="Published Date"
                    value="{{ old('published_date', $post->published_date ?? '') }}">
        </div>
    </div>

    {{-- save and close btns --}}
<div style="width: 50%; position: relative; padding: 20px;">
    <div style="position: absolute; top: 0; right: 0; gap: 10px;">
        <button type="submit" class="btn-orange" id="save-btn" 
                style="margin-right: 15px;
                        margin-bottom: 50px;
                        width: 95px;">
            Save
        </button>
        <button type="button" class="btn-orange" id="close-btn" 
                style= "color: rgb(112, 112, 112);
                        background-color: rgb(218, 218, 218);"
                onclick="window.location.href='/'">
            Cancel
        </button>
    </div>
</div>

</form>


@endsection