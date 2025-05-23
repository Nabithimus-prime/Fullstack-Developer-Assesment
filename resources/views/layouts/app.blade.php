<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Blog')</title>
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
            cursor: pointer;
            outline: none;
            box-shadow: none;
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
        }
    </style>
</head>
<body>

    @yield('content')

</body>
</html>
