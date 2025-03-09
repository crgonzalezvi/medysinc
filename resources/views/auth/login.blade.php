@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="col-md-5">
    <div class="card shadow-lg border-0 rounded-4">
      <div class="card-header bg-white text-center py-4 border-bottom">
        <h3 class="mb-0 text-primary fw-bold">Iniciar Sesión</h3>
      </div>

      <div class="card-body px-5 py-4">
        <form method="POST" action="{{ route('login') }}" id="loginForm">
          @csrf

          <!-- Email Input -->
          <div class="mb-4">
            <label for="email" class="form-label fw-medium text-secondary">Correo Electrónico</label>
            <input id="email" type="email" class="form-control p-3 border-light shadow-sm" name="email" value="{{ old('email') }}" autocomplete="email" autofocus style="border-radius: 8px;">
            <small id="emailError" class="text-danger d-none"></small>
          </div>

          <!-- Password Input -->
          <div class="mb-4">
            <label for="password" class="form-label fw-medium text-secondary">Contraseña</label>
            <input id="password" type="password" class="form-control p-3 border-light shadow-sm" name="password" autocomplete="current-password" style="border-radius: 8px;">
            <small id="loginError" class="text-danger d-none"></small>
            <small id="passwordError" class="text-danger d-none"></small>
          </div>


          <!-- reCAPTCHA -->
          {{-- <div class="mb-4 text-center">
            {!! NoCaptcha::display() !!}
          </div> --}}

          <!-- Login Button -->
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary py-3 fw-bold" style="border-radius: 8px; transition: 0.3s;">
              Iniciar Sesión
            </button>
          </div>

          <!-- Forgot Password Link -->
          <div class="text-center">
            <a class="text-primary text-decoration-none fw-medium" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{!! NoCaptcha::renderJs() !!}

<script>
  let loginError = @json($errors->first('email'));
</script>
<script src="{{ asset('js/login_validation.js') }}"></script>

@if (session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let passwordError = document.getElementById("passwordError");
            passwordError.textContent = "{{ session('error') }}";
            passwordError.classList.remove("d-none");
        });
    </script>
@endif


<!-- Efecto de resalte en los inputs -->
<script>
  $(document).ready(function () {
    $("input").on("focus", function () {
      $(this).css("border-color", "#007BFF");
    }).on("blur", function () {
      $(this).css("border-color", "#e0e0e0");
    });
  });
</script>
@endsection
