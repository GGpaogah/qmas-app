
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
/* Style Global */
*,
*:before,
*:after {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #ffffff;
    overflow-x: hidden;
    overflow-y: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    width: 90%;
    max-width: 400px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    background-color: #fff;
    display: flex;
    flex-direction: column;
}

h3 {
    text-align: center;
    margin-bottom: 20px;
}

p {
    color: #444444; /* Warna gelap untuk kontras yang baik terhadap latar belakang yang lebih terang */
    font-size: 16px; /* Ukuran font yang nyaman untuk dibaca pada kebanyakan perangkat */
    line-height: 1.6; /* Meningkatkan kelegaan teks */
    margin: 10px 0 20px 0; /* Memberikan ruang sebelum dan sesudah paragraf */
    text-align: justify; /* Opsi untuk rata kiri-kanan pada paragraf yang lebih panjang */
    max-width: 600px; /* Membatasi lebar teks untuk memastikan tidak terlalu lebar dan sulit dibaca */
}

/* Jika ingin teks tetap rata kiri tapi lebih tertata, hilangkan 'text-align: justify' dan gunakan ini: */
p {
    text-align: left;
}

input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #00bfff;
    border-radius: 13px;
}

input:focus {
    border-color: #00bfff; /* Menetapkan warna border yang diinginkan ketika fokus */
    outline: none; /* Menghilangkan outline bawaan untuk fokus pada beberapa browser */
}

button {
    width: 100%;
    background-color: #1E90FF;
    color: white;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    border: none;
}

button:hover {
    background-color: #191970;
}

.tambahan {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #1E90FF;
    cursor: pointer;
}

.tambahan a:hover {
    color: #191970;
}

.alert{
    color: red;
}


    </style>
</head>
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<body>  
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{route('password.email')}}" method="post">
        @csrf
        <h3>Lupa Password</h3>

        <p>
            Jika anda lupa dengan password yang anda gunakan, anda dapat melakukan reset password dengan membuat password yang baru. Silahkan masukkan email anda, kami akan mengirim link untuk reset password.
        </p>
        <label for="email">{{ __('Email') }}</label>
        <input type="email" placeholder="Masukkan Email" id="email" name="email" value="{{ old('email') }}" required autofocus>

        <button type="submit" class="btn btn-primary btn-lg" id="button-reset">{{ __('Email Password Reset Link') }}</button>

        <div class="tambahan">
            <a class="login" href="{{ route('login') }}">{{ __('Kembali ke login') }}</a>
        </div>

    </form>
    <script src="{{ asset('resources/vendor/bootstrap/js/bootstrap.min.css') }}"></script>
</body>
</html>
