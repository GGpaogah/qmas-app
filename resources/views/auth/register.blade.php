 <!-- Session Status -->
 <x-auth-session-status class="mb-4" :status="session('status')" />
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.6.0/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - QMAS</title>
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

.input-container {
            position: relative;
        }

        /* Position the eye icon inside the input field */
        .field-icon {
            position: absolute;
            right: 10px;
            top: 55%;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 1;
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
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <h3>Daftar Akun</h3>

        <label for="name">{{ __('Nama') }}</label>
        <input type="text" placeholder="Nama Lengkap" id="name" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">{{ __('Email') }}</label>
        <input type="email" placeholder="Masukkan Email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="email">{{ __('Nomor') }}</label>
        <input type="tel" placeholder="Masukkan Nomor" id="number" name="number" maxlength="13" value="{{ old('email') }}" required>

        <!-- Validation Error for Password -->
        <div class="input-container">
           <label for="password">{{ __('Password') }}</label>
           <input type="password" placeholder="Masukkan Password" id="password" name="password" required autocomplete="new-password">
           <span toggle="#password" class="fa-solid fa-eye field-icon toggle-password"></span>
           @error('password')
               <div class="alert alert-danger mb-4">
                   {{ $message }}
               </div>
           @enderror
        </div>

        
        <div class="input-container">
           <label for="password_confirmation">{{ __('Confirm Password') }}</label>
           <input type="password" placeholder="Konfirmasi Password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
           <span toggle="#password_confirmation" class="fa-solid fa-eye field-icon toggle-confirm-password"></span>
           @error('password')
               <div class="alert alert-danger mb-4">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-lg">{{ __('Register') }}</button>

        <div class="tambahan">
            <a class="login" href="{{ route('login') }}">{{ __('Sudah punya akun?') }}</a>
        </div>
    </form>
    <script>
        document.querySelector(".toggle-password").addEventListener('click', function() {
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
            var input = document.querySelector(this.getAttribute("toggle"));
            if (input.getAttribute("type") === "password") {
                input.setAttribute("type", "text");
            } else {
                input.setAttribute("type", "password");
            }
        });

        document.querySelector(".toggle-confirm-password").addEventListener('click', function() {
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
            var input = document.querySelector(this.getAttribute("toggle"));
            if (input.getAttribute("type") === "password") {
                input.setAttribute("type", "text");
            } else {
                input.setAttribute("type", "password");
            }
        });

    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
