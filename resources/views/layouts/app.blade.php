<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>

        .add-new-btn {
            text-align: left;
            margin-top: 50px;
            margin-left: 25px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(252, 252, 252);
        }

        .blog-card {
            display: flex;
            background-color: white;
            box-shadow: 2px 8px 5px rgba(113, 113, 113, 0.05);
            padding-top: 0;
            margin: 30px 25px;
            overflow: hidden;
        }

        .blog-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-content {
            width: 70%;
            padding: 25px;
            position: relative;
        }

        .blog-excerpt {
            margin: 20px 0 40px;
            color: rgb(112, 112, 112);
            font-weight: bold;
            font-size: clamp(8px, 3vw, 12px);
        }

        .blog-slug {
            margin-top: 0;
            color: rgb(112, 112, 112);
            font-weight: bolder;
            font-size: clamp(16px, 3vw, 24px);
        }

        .btn-orange {
            background-color: rgb(223, 68, 37);
            color: white;
            padding: 10px 25px;
            display: inline-block;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
            border: none;
        }

        .card-actions {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: clamp(12px, 2vw, 16px);
        }

        .card-actions i {
            margin-right: clamp(10px, 3vw, 15px);
            color: rgb(116, 116, 116);
        }

        .cancel-btn {
            background-color: rgb(218, 218, 218);
            color: rgb(112, 112, 112);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding-top: 20px;
        }

        .form-container {
            padding: 0 30px 30px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-field {
            flex: 2;
            width: 100%;
        }

        .form-field input,
        .form-field textarea,
        .form-field input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            outline: none;
            border-radius: 4px;
            margin-top: 5px;
            text-align: left;
        }

        .form-label {
            flex: 1;
            font-weight: bold;
            color: #555;
            margin-top: 10px;
            font-size: 14px;
        }

        .form-row {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .icon-area {
            display: flex;
            gap: 15px;
        }

        .icon-button {
            color: gray;
            text-decoration: none;
            font-size: 14px;
        }

        input::placeholder {
            font-family: 'Poppins', sans-serif;
            color: rgb(190, 190, 190);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px;
            color: #707070;
        }

        .page-header h2 {
            margin: 0;
        }

        .slug-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        textarea {
            resize: none;
        }

        textarea::placeholder {
            font-family: 'Poppins', sans-serif;
            color: rgb(190, 190, 190);
        }

    </style>
</head>

<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d/m/Y",
            allowInput: true,
            defaultDate: null
        });
    </script>

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
                        font-size: 12px;">
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
        const createPostForm = document.getElementById('createPostForm');
        const deletePostForm = document.getElementById('deletePostForm');  
        let currentAction = null;
        let currentPostId = null;

        function openModal(type, postId = null) {
            modalOverlay.style.display = 'flex'; 

            if(type === 'delete') {
                currentPostId = postId;

                if (document.getElementById('createPostForm')) {
                    modalMessage.textContent = 'Are you sure you want to clear the post?';
                    modalYes.onclick = () => {
                        const form = document.getElementById('createPostForm');
                        form.reset(); 

                        form.querySelectorAll('input[type="text"], input[type="email"], textarea, select').forEach(field => {
                            field.value = '';
                        });
                        
                        const fileInput = form.querySelector('input[type="file"]');
                        if (fileInput) fileInput.value = '';

                        const previewImg = form.querySelector('img');
                        if (previewImg) previewImg.remove();
                        closeModal();
                    };
                } else {   
                    modalMessage.textContent = 'Are you sure you want to delete this post?';
                    modalYes.onclick = () => {
                        deletePostForm.action = `/posts/${currentPostId}`;
                        deletePostForm.submit();
                    };
                }
            
            }else if(type === 'edit') {
                modalMessage.textContent = 'Would you like to make changes to this post?';
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
                const postId = el.getAttribute('data-post-id'); 
                openModal('edit', postId);
            });
        });

        document.querySelectorAll('.delete-icon').forEach(el => {
            el.addEventListener('click', e => {
                const postId = el.getAttribute('data-post-id');
                openModal('delete', postId);
            });
        });
    </script>

@stack('scripts')
</body>
</html>
