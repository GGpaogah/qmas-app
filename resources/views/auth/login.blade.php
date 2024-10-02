<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('resources/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-6.6.0/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]> 
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>Login - QMAS</title>
    <style>
        /* Global Colors - The following color variables are used throughout the website */
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
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
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            background-color: #fff;
            display: flex;
            flex-direction: column;
        }
        
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type='email'],
        input[type='password'],
        input[type='text'] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #00bfff; /* Maintain the border style */
            border-radius: 13px;
            padding-right: 40px; /* Leave space for the icon inside the input */
            position: relative;
        }

        /* Keep the border color the same when focused */
        input[type='email']:focus,
        input[type='password']:focus,
        input[type='text']:focus {
            border-color: #00bfff; /* Maintain border color */
            outline: none;
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

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 10px;
            cursor: pointer;
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

        .alert {
            color: red;
        }

    </style>
    
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="{{ route('login') }}" method="post" class="login-form">
    @csrf
    <h3>Silahkan Login</h3>
    
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Validation Error for Email -->
    <label for="email">{{ __('Email') }}</label>
    <input type="email" placeholder="Masukkan Email" id="email" name="email" value="{{ old('email') ?? $rememberedEmail ?? '' }}" required autofocus>
    @error('email')
        <div class="alert alert-danger mb-4">
            {{ $message }}
        </div>
    @enderror

    <!-- Email or Password Error -->
    @if (session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Error for Password -->
    <div class="input-container">
        <label for="password">{{ __('Password') }}</label>
        <input type="password" placeholder="Masukkan Password" id="password" name="password" required>
        <span toggle="#password" class="fa-solid fa-eye field-icon toggle-password"></span>
        @error('password')
            <div class="alert alert-danger mb-4">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Remember Me Checkbox -->
    <div class="remember-me">
    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label for="remember">{{ __('Ingat saya') }}</label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg" id="button-login">{{ __('Log in') }}</button>

    <div class="tambahan">
        <a href="{{ route('register') }}" class="daftar">{{ __('Daftar') }}</a>
        <!-- <div class="batas">|</div> -->
        <a href="{{ route('password.request') }}" class="forget">{{ __('Lupa password?') }}</a>
    </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Toggle password visibility
    const togglePassword = document.querySelector(".toggle-password");
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
            const input = document.querySelector(this.getAttribute("toggle"));
            if (input) {
                if (input.type === "password") {
                    input.type = "text";
                } else {
                    input.type = "password";
                }
            }
        });
    }
});
</script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
