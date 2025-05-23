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
                    <img src="{{ asset($post['image']) }}"
                        style= "width: 100%; 
                                height: 100%; 
                                object-fit: cover;"
                    >
                </div>

                <!-- content -->
                <div style="width: 70%; 
                            padding: 25px; 
                            position: relative;">

                    <!-- title -->
                    <div style="margin-top: 0; 
                                color: rgb(112, 112, 112);
                                font-weight: bolder ;
                                font-size: clamp(16px, 3vw, 24px)">
                                {{ $post['title'] }}
                    </div>

                    <!-- Edit & Delete -->
                    <div style="position: absolute;
                                top: 20px;
                                right: 25px; 
                                font-size: clamp(px, 2vw, 16px)">

                        <a href="#" class="edit-icon" data-post-id="1">
                            <i class= "fas fa-pen" 
                                style= "margin-right: clamp(10px, 3vw, 15px); 
                                        color: rgb(116, 116, 116)">
                            </i>
                        </a>
                        
                        <a href="#" class="delete-icon" data-post-id="1">
                            <i class="fas fa-trash" 
                                style="color: rgb(116, 116, 116);">
                            </i>
                        </a>
                    </div>

                    <!-- Excerpt -->
                    <p style="margin: 20px 0; 
                            color: rgb(112, 112, 112);
                            font-weight: bold ;
                            font-size: clamp(8px, 3vw, 12px)">
                            {{ $post['excerpt'] }} 
                    </p>

                    <!-- Read more button -->
                    <a href="{{  url('posts') }}" 
                        class="btn-orange" 
                        style= "padding: 8px 15px;
                                font-size: clamp(4px, 2vw, 12px);">
                        Read More ➡
                    </a>

                </div> <!-- closing content -->
                    
            </div> <!-- closing blog card -->
        @endforeach

    </div>

    <!-- Modal box --> 
    <div id="modalOverlay" 
        style= "display: none;
                position: fixed;
                top: 0; left: 0;
                width: 100%; height: 100%;
                background: rgba(0,0,0,0.6);
                z-index: 1000;
                justify-content: center;
                align-items: center; ">

        <!-- white box -->
        <div style="background: white;
                    padding: 30px;
                    width: 200px;
                    height: 100px;
                    position: relative;
                    text-align: center;">
            
            <!-- X icon -->
            <span id= "modalClose" 
                style= "position: absolute;
                        top: 8px; right: 12px;
                        font-size: 18px;
                        cursor: pointer;
                        color: rgb(110, 110, 110);">
                &times;
            </span>

            <!-- message -->
            <p id= "modalMessage" 
                style= "margin-bottom: 20px;
                        margin-top:auto;
                        font-weight:bolder;
                        color: rgb(110, 110, 110);
                        font: size 12px;">
            </p>

            <!-- Yes and No buttons -->
            <button class= "btn-orange" id= "modalYes" 
                    style= "margin-right: 10px;
                            border: none ;">
                Yes
            </button>
            <button class="btn-orange" id= "modalNo"
                    style= "background-color:rgb(218, 218, 218);
                            color: rgb(112, 112, 112);
                            border: none ;">
                No
            </button>

        </div>

    </div>

    <script>
        // modal overlay
        const modalOverlay = document.getElementById('modalOverlay');
        const modalClose = document.getElementById('modalClose');
        const modalYes = document.getElementById('modalYes');
        const modalNo = document.getElementById('modalNo');
        const modalMessage = document.getElementById('modalMessage');
        let currentAction = null;

        function openModal(type, postId) {
            modalOverlay.style.display = 'flex'; 

        if(type === 'delete') {
            modalMessage.textContent = 'Are you sure you want to delete this post?';
            modalYes.onclick = () => {
            // delete post from databse
            };
        } else if(type === 'edit') {
            modalMessage.textContent = 'Do you want to edit this post?';
            modalYes.onclick = () => {
            window.location.href = `/posts/${postId}/edit`;
            };
        }
        }

        function closeModal() {
        modalOverlay.style.display = 'none';
        }

        modalNo.onclick = closeModal;
        modalClose.onclick = closeModal;

        document.querySelectorAll('.edit-icon').forEach(el => {
            el.addEventListener('click', e => {
                const postId = e.target.dataset.postId; 
                openModal('edit', postId);
            });
        });

        document.querySelectorAll('.delete-icon').forEach(el => {
            el.addEventListener('click', e => {
                const postId = e.target.dataset.postId;
                openModal('delete', postId);
            });
        });
    </script>

@endsection
