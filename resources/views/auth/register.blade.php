@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
     <div class="col-md-8">
       <div class="card shadow-sm" style="border: none; border-radius: 10px;">
         <div class="card-header bg-white text-center py-4" style="border-bottom: 1px solid #e0e0e0;">
           <h3 class="mb-0" style="font-weight: 600; color: #007BFF;">Registro</h3>
         </div>
         <div class="card-body px-5 py-4">
           <!-- Se asigna un id al formulario para la validación -->
           <form method="POST" action="{{ route('register') }}" id="registerForm">
             @csrf

             <!-- Nombre -->
             <div class="mb-4">
               <label for="name" class="form-label" style="color: #333333; font-weight: 500;">Nombre</label>
               <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <!-- Contenedor de error para el Nombre -->
               <small id="nameError" class="text-danger d-none"></small>
             </div>

             <!-- Correo Electrónico -->
             <div class="mb-4">
               <label for="email" class="form-label" style="color: #333333; font-weight: 500;">Correo Electrónico</label>
               <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  autocomplete="email" style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="emailError" class="text-danger d-none"></small>
             </div>

             <!-- Tipo de Documento -->
             <div class="mb-4">
               <label for="document_type" class="form-label" style="color: #333333; font-weight: 500;">Tipo de Documento</label>
               <select id="document_type" class="form-control" name="tipo_documento"  style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
                 <option value="">Seleccione el tipo de documento</option>
                 <option value="CC">Cédula de Ciudadanía (CC)</option>
                 <option value="TI">Tarjeta de Identidad (TI)</option>
                 <option value="CE">Cédula de Extranjería (CE)</option>
               </select>
               <small id="documentTypeError" class="text-danger d-none"></small>
             </div>

             <!-- Número de Documento -->
             <div class="mb-4">
               <label for="documento" class="form-label" style="color: #333333; font-weight: 500;">Número de Documento</label>
               <input id="documento" type="number" class="form-control" name="documento" value="{{ old('documento') }}"  autocomplete="documento" style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="documentoError" class="text-danger d-none"></small>
             </div>

             <!-- Teléfono -->
             <div class="mb-4">
               <label for="telefono" class="form-label" style="color: #333333; font-weight: 500;">Teléfono</label>
               <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}"  autocomplete="telefono" style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="telefonoError" class="text-danger d-none"></small>
             </div>

             <!-- Fecha de Nacimiento -->
             <div class="mb-4">
               <label for="birthdate" class="form-label" style="color: #333333; font-weight: 500;">Fecha de Nacimiento</label>
               <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}"  style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="birthdateError" class="text-danger d-none"></small>
             </div>

             <!-- Género -->
             <div class="mb-4">
               <label for="gender" class="form-label" style="color: #333333; font-weight: 500;">Género</label>
               <select id="gender" class="form-control" name="gender"  style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
                 <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                 <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                 <option value="Otro" {{ old('gender') == 'Otro' ? 'selected' : '' }}>Otro</option>
               </select>
               <small id="genderError" class="text-danger d-none"></small>
             </div>

             <!-- Dirección -->
             <div class="mb-4">
               <label for="adress" class="form-label" style="color: #333333; font-weight: 500;">Dirección</label>
               <input id="adress" type="text" class="form-control" name="adress" value="{{ old('adress') }}"  style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="adressError" class="text-danger d-none"></small>
             </div>

             <!-- Contraseña -->
             <div class="mb-4">
               <label for="password" class="form-label" style="color: #333333; font-weight: 500;">Contraseña</label>
               <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password" style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="passwordError" class="text-danger d-none"></small>
             </div>

             <!-- Confirmar Contraseña -->
             <div class="mb-4">
               <label for="password-confirm" class="form-label" style="color: #333333; font-weight: 500;">Confirmar Contraseña</label>
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" style="border-radius: 5px; border: 1px solid #e0e0e0; padding: 0.75rem;">
               <small id="passwordConfirmError" class="text-danger d-none"></small>
             </div>

             <!-- Botón de Registro -->
             <div class="d-grid mb-3">
               <button type="submit" class="btn btn-primary" style="border-radius: 5px; padding: 0.75rem; background-color: #007BFF; border: none; font-weight: 600;">
                 Registrarse
               </button>
             </div>
           </form>
         </div>
       </div>
     </div>
  </div>
</div>
<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluir el archivo de validaciones -->
<script src="{{ asset('js/validation.js') }}"></script>
@endsection
