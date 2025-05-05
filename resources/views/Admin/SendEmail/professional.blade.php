<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
        }
        h1 { color: #ff009d; }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Company Logo --}}
        <img src="{{asset('files/main_images/logo/logo2.png')}}" alt="Company Logo" class="logo">

        <h1>{{ $subjectLine }}</h1>
        <p>{!! nl2br(e($bodyMessage)) !!}</p>
        {{-- <p>Best regards,<br>Rosa</p> --}}
    </div>
</body>
</html>
