@extends('layouts.app')

@section('content')

    <div style="margin: 25px;">

        <!-- add new button -->
        <div class="add-new-btn">
            <a href="{{  url('posts/create') }}" class="btn btn-orange">
                + Add New
            </a>
        </div> 

        @foreach ($posts as $post)

            <!-- blog card -->
            <div class="blog-card">
                
                <!-- image -->
                <div style= "width: 30%;">
                    <img src="{{ asset('storage/' . $post['featured_image']) }}">
                </div>

                <!-- content -->
                <div class="blog-content">

                    <!-- slug & icons -->
                    <div class="slug-actions">
                        <div class="blog-slug">{{ $post['slug'] }}</div>

                        <div class="icon-area">
                            <a href="#" class="icon-button edit-icon" data-post-id="{{ $post->id }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="#" class="icon-button delete-icon" data-post-id="{{ $post->id }}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <!-- excerpt -->
                    <p class="blog-excerpt">{{ $post['excerpt'] }}</p>

                    <!-- read more button -->
                    <div>
                        <a href="{{ url('posts/' . $post['id']) }}" class="btn-orange" style="padding: 8px 15px; font-size: 12px">
                            Read More ➡
                        </a>
                    </div>

                </div> 
                    
            </div> 
        @endforeach

    </div>

    <form id="deletePostForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

@endsection