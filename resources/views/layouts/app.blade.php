<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Blog')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(252, 252, 252);
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

        .form-row {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .form-label {
            flex: 1;
            font-weight: bold;
            color: #555;
            margin-top: 10px;
            font-size: 14px;
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

        textarea::placeholder {
            font-family: 'Poppins', sans-serif;
            color: rgb(190, 190, 190);
        }

        textarea {
            resize: none;
        }

        input::placeholder {
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

                if (createPostForm) {
                    modalMessage.textContent = 'Are you sure you want to clear the post?';
                    modalYes.onclick = () => {
                        document.getElementById('createPostForm').reset();
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

</body>
</html>
