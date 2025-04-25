@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: url('{{ asset("images/herramienta.jpeg") }}') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 25px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        padding: 30px;
        width: 100%;
        max-width: 400px;
        animation: fadeIn 1s ease-in-out;
        position: relative; /* Para posicionar el botón del ojo */
    }

    .login-header {
        background-color: #FF7F50;
        border-radius: 20px 20px 0 0;
        text-align: center;
        padding: 20px;
        color: white;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .form-label {
        margin-bottom: 0.5rem;
        font-weight: 700; /* Texto más grueso */
        color: black; /* Texto negro */
    }

    .form-control {
        border-radius: 12px;
        border: 1px solid #ccc;
        padding: 14px;
        font-size: 1rem;
        background-color: white;
        color: #333; /* Color del texto dentro del input */
    }

    .form-control:focus {
        border-color: #FF7F50;
        box-shadow: 0 0 0 0.2rem rgba(255, 127, 80, 0.3);
    }

    .login-button {
        background-color: #FF7F50;
        border: none;
        color: white;
        font-size: 1rem;
        padding: 12px;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .login-button:hover {
        background-color: #e66c3b;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #dc3545;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
    }
</style>

<div class="container login-container">
    <div class="login-card">
        <div class="login-header">
            {{ __('Ingreso al Sistema') }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" onsubmit="return validarFormulario()">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Correo electrónico:') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small id="emailError" class="text-danger"></small>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Contraseña:') }}</label>
                    <div style="position: relative;">
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password">
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small id="passwordError" class="text-danger"></small>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn login-button">
                        {{ __('Ingresar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validarFormulario() {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let emailError = document.getElementById("emailError");
        let passwordError = document.getElementById("passwordError");
        let valid = true;

        emailError.innerText = "";
        passwordError.innerText = "";

        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            emailError.innerText = "Por favor, ingrese un correo electrónico válido.";
            valid = false;
        }

        if (password.length < 8) {
            passwordError.innerText = "La contraseña debe tener al menos 8 caracteres.";
            valid = false;
        }

        return valid;
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.querySelector(".password-toggle i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection