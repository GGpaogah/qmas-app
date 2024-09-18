<x-auth-session-status class="mb-4" :status="session('status')" />
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('resources/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qmas</title>
    <style>
        /* CSS styles here */
        /* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
:root {
    --background-color: #ffffff;
    --default-color: #444444;
    --heading-color: #0a2a62;
    --accent-color: #1b3bee;
    --surface-color: #ffffff;
    --contrast-color: #ffffff;
}
/* Smooth scroll */
:root {
    scroll-behavior: smooth;
}

*,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #ffffff;
    overflow-x: hidden;
    overflow-y: hidden;
}
/* Login dan Register page css */
.background {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0; 
    left: 0;
    z-index: -1;
    display: flex;
    justify-content: center;
    align-items: center;
}
.shape {
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, #00bfff, #00ace5);
    position: absolute;
    border-radius: 50%;
    filter: blur(70px);
}
.shape:nth-child(1) {
    top: -50px;
    left: -50px;
}

.shape:nth-child(2) {
    bottom: -50px;
    right: -50px;
}
form{
    height: 520px;
    width: 400px;
    background-color: #ffffff;
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #4682B4;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    color: #003040;
}
label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
    color: #4682B4;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: #f0faff;
    border: 1px solid #00bfff;
    border-radius: 13px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #4682B4;
}
input:hover{
    background-color: #ffffff;
    color: #080710;
}
::placeholder:hover{
    color:#000000;
}
.btn{
    margin-top: 30px;
    width: 100%;
    background-color: #1E90FF;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
}
button:hover{
    background-color: #191970;
    color: #ffffff;
    cursor: pointer;
}
.tambahan{
    margin-top: 30px;
    display: flex;
}
.batas{
    margin-left: 5px;
    margin-right: 5px;
}
.batas, .daftar, .forget{
    color: #1E90FF;
}
.daftar:hover, .forget:hover{
    color: #191970;
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <h3>Lupa Password</h3>
        <p>
            Jika anda lupa dengan password yang anda gunakan, anda dapat melakukan reset password dengan membuat password yang baru. Silahkan masukkan email anda, kami akan mengirim link untuk reset password.
        </p>
        <label for="email">{{ __('Email') }}</label>
        <input type="email" placeholder="Masukkan Email" id="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">{{ __('Password') }}</label>
        <input type="password" placeholder="Masukkan Password" id="password" name="password" required>

        <button type="submit" class="btn btn-primary btn-lg" id="button-login">{{ __('Log in') }}</button>

        <div class="tambahan">
            <a href="{{ route('register') }}" class="daftar">{{ __('Daftar') }}</a>
            <div class="batas">|</div>
            <a href="{{ route('password.request') }}" class="forget">{{ __('Lupa password?') }}</a>
        </div>
    </form>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
