@extends('layouts.app')

@section('content')

    <div style="margin: 25px;">

        <!-- add new button -->
        <div style="text-align: left; 
                    margin-top: 50px; 
                    margin-left: 25px;">

            <a href="{{  url('posts/create') }}" class="btn btn-orange">
                + Add New
            </a>
        </div> 

        @foreach ($posts as $post)
            <!-- blog card -->
            <div style="display: flex; 
                        background-color: rgb(255, 255, 255);
                        box-shadow: 2px 8px 5px rgba(113, 113, 113, 0.05);
                        padding-top: 0px; 
                        margin: 30px 25px;
                        overflow: hidden;"> 
                
                <!-- image -->
                <div style= "width: 30%;">
                    <img src="{{ asset('storage/' . $post['featured_image']) }}"
                        style= "width: 100%; 
                                height: 100%; 
                                object-fit: cover;">
                </div>

                <!-- content -->
                <div style="width: 70%; 
                            padding: 25px; 
                            position: relative;">

                    <!-- slug -->
                    <div style="margin-top: 0; 
                                color: rgb(112, 112, 112);
                                font-weight: bolder ;
                                font-size: clamp(16px, 3vw, 24px)">
                                {{ $post['slug'] }}
                    </div>

                    <!-- Edit & Delete -->
                    <div style="position: absolute;
                                top: 20px;
                                right: 25px; 
                                font-size: clamp(px, 2vw, 16px);">

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

                    <!-- Excerpt -->
                    <p style="margin: 20px 0px 40px 0px; 
                            color: rgb(112, 112, 112);
                            font-weight: bold ;
                            font-size: clamp(8px, 3vw, 12px)">
                            {{ $post['excerpt'] }} 
                    </p>

                    <!-- Read more button -->
                    <div style="margin-top:auto">
                        <a href="{{ url('posts/' . $post['id']) }}" 
                            class="btn-orange" 
                            style= "padding: 8px 15px;
                                    font-size: clamp(4px, 2vw, 12px);">
                            Read More ➡
                        </a>
                    </div>

                </div> <!-- closing content -->
                    
            </div> <!-- closing blog card -->
        @endforeach

    </div>

    <form id="deletePostForm" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

@endsection
