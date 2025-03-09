import './bootstrap';

$(document).ready(function () {
    $("#patientForm").submit(function (event) {
        let isValid = true;

        // Nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");

        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Correo Electrónico
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        if (!emailPattern.test(email)) {
            emailError.text("Ingrese un correo válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Tipo de Documento
        let tipoDocumento = $("#tipo_documento").val().trim();
        let tipoDocumentoError = $("#tipoDocumentoError");

        if (tipoDocumento === "") {
            tipoDocumentoError.text("El tipo de documento es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            tipoDocumentoError.addClass("d-none");
        }


        // Documento (exactamente 9 dígitos)
        let documento = $("#documento").val().trim();
        let documentoError = $("#documentoError");

        if (!/^\d{5,10}$/.test(documento)) {
            documentoError.text("El documento debe contener entre 5 y 10 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }


        // Teléfono (mínimo 7 y máximo 15 dígitos)
        let telefono = $("#telefono").val().trim();
        let telefonoError = $("#telefonoError");

        if (!/^\d{7,15}$/.test(telefono)) {
            telefonoError.text("El teléfono debe contener entre 7 y 15 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }

        // Fecha de Nacimiento
        let birthdate = $("#birthdate").val();
        let birthdateError = $("#birthdateError");
        let today = new Date();
        let birthDateObj = new Date(birthdate);
        let age = today.getFullYear() - birthDateObj.getFullYear();
        let monthDiff = today.getMonth() - birthDateObj.getMonth();

        // Ajuste de edad si el cumpleaños aún no ha ocurrido este año
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDateObj.getDate())) {
            age--;
        }

        if (!birthdate) {
            birthdateError.text("Ingrese una fecha válida.").removeClass("d-none");
            isValid = false;
        } else if (birthDateObj > today) {
            birthdateError.text("La fecha no puede ser en el futuro.").removeClass("d-none");
            isValid = false;
        } else if (age > 120) {
            birthdateError.text("Ingrese una edad realista.").removeClass("d-none");
            isValid = false;
        } else {
            birthdateError.addClass("d-none");
        }

        // Género
        let gender = $("#gender").val();
        let genderError = $("#genderError");

        if (gender === "") {
            genderError.text("Seleccione un género.").removeClass("d-none");
            isValid = false;
        } else {
            genderError.addClass("d-none");
        }

        // Contraseñas (si existen en el formulario)
        if ($("#password").length && $("#password-confirm").length) {
            let password = $("#password").val();
            let confirmPassword = $("#password-confirm").val();
            let passwordError = $("#passwordError");
            let confirmPasswordError = $("#confirmPasswordError");

            if (password.length < 6) {
                passwordError.text("La contraseña debe tener al menos 6 caracteres.").removeClass("d-none");
                isValid = false;
            } else {
                passwordError.addClass("d-none");
            }

            if (password !== confirmPassword) {
                confirmPasswordError.text("Las contraseñas no coinciden.").removeClass("d-none");
                isValid = false;
            } else {
                confirmPasswordError.addClass("d-none");
            }
        }

        // Especialidad (solo en doctorForm)
        if ($("#specialties_id").length) {
            let specialty = $("#specialties_id").val();
            let specialtyError = $("#specialtyError");

            if (!specialty) {
                specialtyError.text("Seleccione una especialidad.").removeClass("d-none");
                isValid = false;
            } else {
                specialtyError.addClass("d-none");
            }
        }

        // Si hay errores, evitamos el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});


$(document).ready(function () {
    $("#doctorForm").submit(function (event) {
        let isValid = true;

        // Nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");

        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Correo Electrónico
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        if (!emailPattern.test(email)) {
            emailError.text("Ingrese un correo válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Contraseña
        let password = $("#password").val();
        let confirmPassword = $("#password_confirmation").val();
        let passwordError = $("#passwordError");
        let confirmPasswordError = $("#confirmPasswordError");

        if (password.length < 6) {
            passwordError.text("La contraseña debe tener al menos 6 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            passwordError.addClass("d-none");
        }

        if (password !== confirmPassword) {
            confirmPasswordError.text("Las contraseñas no coinciden.").removeClass("d-none");
            isValid = false;
        } else {
            confirmPasswordError.addClass("d-none");
        }

        // Tipo de Documento
        let tipoDocumento = $("#document_type").val().trim();
        let tipoDocumentoError = $("#tipoDocumentoError");

        if (tipoDocumento === "") {
            tipoDocumentoError.text("El tipo de documento es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            tipoDocumentoError.addClass("d-none");
        }

        // Documento (exactamente 9 dígitos)
        let documento = $("#documento").val().trim();
        let documentoError = $("#documentoError");

        if (!/^\d{5,10}$/.test(documento)) {
            documentoError.text("El documento debe contener entre 5 y 10 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }


        // Teléfono (mínimo 7 y máximo 15 dígitos)
        let telefono = $("#telefono").val().trim();
        let telefonoError = $("#telefonoError");

        if (!/^\d{7,15}$/.test(telefono)) {
            telefonoError.text("El teléfono debe contener entre 7 y 15 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }

        // Especialidad
        let specialty = $("#specialties_id").val();
        let specialtyError = $("#specialtyError");

        if (!specialty) {
            specialtyError.text("Seleccione una especialidad.").removeClass("d-none");
            isValid = false;
        } else {
            specialtyError.addClass("d-none");
        }

        // Si hay errores, evitar el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});



$(document).ready(function () {
    $("#adminForm").submit(function (event) {
        let isValid = true;

        // Validación del nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");

        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Validación del email
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

        if (!emailPattern.test(email)) {
            emailError.text("Ingrese un correo válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Tipo de Documento
        let tipoDocumento = $("#document_type").val();
        let tipoDocumentoError = $("#tipoDocumentoError");

        if (tipoDocumento === "") {
            tipoDocumentoError.text("El tipo de documento es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            tipoDocumentoError.addClass("d-none");
        }



        // Obtener valores
        let documento = $("#documento").val().trim();
        let telefono = $("#telefono").val().trim();

        // Seleccionar los elementos de error
        let documentoError = $("#documentoError");
        let telefonoError = $("#telefonoError");

        // Validar Documento (exactamente 10 dígitos numéricos)
        if (!/^\d{5,10}$/.test(documento)) {
            documentoError.text("El documento debe contener entre 5 y 10 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }


        // Validar Teléfono (entre 7 y 15 dígitos numéricos)
        if (!/^\d{7,15}$/.test(telefono)) {
            telefonoError.text("El teléfono debe contener entre 7 y 15 dígitos numéricos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }

        // Si hay errores, prevenir el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }

        // Contraseñas
        let password = $("#password").val();
        let confirmPassword = $("#password_confirmation").val();
        let passwordError = $("#passwordError");
        let confirmPasswordError = $("#confirmPasswordError");

        if (password.length < 6) {
            passwordError.text("La contraseña debe tener al menos 6 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            passwordError.addClass("d-none");
        }

        if (password !== confirmPassword) {
            confirmPasswordError.text("Las contraseñas no coinciden.").removeClass("d-none");
            isValid = false;
        } else {
            confirmPasswordError.addClass("d-none");
        }

        // Si hay errores, evitamos el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    $("#editDoctorForm").submit(function (event) {
        let isValid = true;

        // Validación del nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");
        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Validación del email
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!emailPattern.test(email)) {
            emailError.text("Ingrese un correo válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Tipo de Documento
        let documentType = $("#document_type").val();
        let documentTypeError = $("#documentTypeError");
        if (documentType === "") {
            documentTypeError.text("El tipo de documento es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            documentTypeError.addClass("d-none");
        }

        // Documento
        let documento = $("#documento").val().trim();
        let documentError = $("#documentError"); // Asegúrate de que este ID coincide en tu HTML

        // Convertimos a número para validar si es negativo
        let numeroDocumento = Number(documento);

        // Validamos que solo contenga entre 5 y 10 dígitos y que no sea negativo
        if (!/^\d{5,10}$/.test(documento) || numeroDocumento < 0) {
            documentError.text("El documento debe tener entre 5 y 10 dígitos y no puede ser negativo.")
                .removeClass("d-none")
                .show(); // Aseguramos que el error se muestre
            isValid = false;
        } else {
            documentError.addClass("d-none").hide();
        }

        // Si hay errores, evitar el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }


        // Validar Teléfono (solo números, sin negativos, máximo 15 dígitos)
        let telefono = $("#telefono").val().trim();
        let telefonoError = $("#telefonoError");
        const MAX_TELEFONO = 999999999999999; // 15 dígitos

        if (telefono === "" || !/^\d+$/.test(telefono) || BigInt(telefono) > MAX_TELEFONO) {
            telefonoError.text("El teléfono debe ser un número válido y no mayor a 15 dígitos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }

        // Especialidad
        let specialty = $("#specialties_id").val();
        let specialtyError = $("#specialtyError");
        if (specialty === "") {
            specialtyError.text("Debe seleccionar una especialidad.").removeClass("d-none");
            isValid = false;
        } else {
            specialtyError.addClass("d-none");
        }

        // Si hay errores, evitamos el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});

$(document).ready(function () {
    $("#editAdminForm").submit(function (event) {
        let isValid = true;

        // Validación del nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");

        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Validación del email
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(email)) {
            emailError.text("Ingrese un correo válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Tipo de Documento
        let tipoDocumento = $("#document_type").val();
        let tipoDocumentoError = $("#tipoDocumentoError");

        if (tipoDocumento === "") {
            tipoDocumentoError.text("El tipo de documento es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            tipoDocumentoError.addClass("d-none");
        }

        // Validación del Documento (mínimo 5 dígitos, máximo 10, solo números positivos)
        let documento = $("#documento").val().trim();
        let documentoError = $("#documentoError");

        if (!/^\d{5,10}$/.test(documento) || parseInt(documento) < 0) {
            documentoError.text("El documento debe tener entre 5 y 10 dígitos y no puede ser negativo.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }

        // Validación del Teléfono
        let telefono = $("#telefono").val().trim();
        let telefonoError = $("#telefonoError");

        if (!/^\d{5,15}$/.test(telefono)) {
            telefonoError.text("El teléfono debe tener entre 5 y 15 dígitos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }

        // Evitar el envío si hay errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});




$(document).ready(function () {
    $("#createRoleForm").submit(function (event) {
        let isValid = true;

        // Validación del nombre del rol
        let name = $("#name").val().trim();
        let nameError = $("#nameError");

        if (name === "") {
            nameError.text("El nombre del rol es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            nameError.text("El nombre del rol debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Si hay errores, evitamos el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});

$(document).ready(function () {
    $("#appointmentForm").submit(function (event) {
        let isValid = true;

        // Validar Especialidad
        let specialty = $("#specialty").val().trim();
        let specialtyError = $("#specialtyError");
        if (specialty === "") {
            specialtyError.text("Seleccione una especialidad.").removeClass("d-none");
            isValid = false;
        } else {
            specialtyError.addClass("d-none");
        }

        // Validar Doctor
        let doctor = $("#doctor").val().trim();
        let doctorError = $("#doctorError");
        if (doctor === "") {
            doctorError.text("Seleccione un doctor.").removeClass("d-none");
            isValid = false;
        } else {
            doctorError.addClass("d-none");
        }

        // Validar Fecha y Hora de la cita
        let appointmentDate = $("#appointment_date").val().trim();
        let appointmentDateError = $("#appointmentDateError");
        if (appointmentDate === "") {
            appointmentDateError.text("La fecha y hora de la cita son obligatorias.").removeClass("d-none");
            isValid = false;
        } else {
            let appointmentDateObj = new Date(appointmentDate);
            let now = new Date();
            if (appointmentDateObj < now) {
                appointmentDateError.text("La fecha y hora deben ser en el futuro.").removeClass("d-none");
                isValid = false;
            } else {
                appointmentDateError.addClass("d-none");
            }
        }

        // Validar Motivo de la cita (opcional, pero con mínimo 10 caracteres si se ingresa)
        let reason = $("#reason").val().trim();
        let reasonError = $("#reasonError");
        if (reason !== "" && reason.length < 10) {
            reasonError.text("El motivo de la cita debe tener al menos 10 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            reasonError.addClass("d-none");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    $("#attendAppointmentForm").submit(function (event) {
        let isValid = true;

        // Validar Diagnóstico
        let diagnosis = $("#diagnosis").val().trim();
        let diagnosisError = $("#diagnosisError");
        if (diagnosis === "") {
            diagnosisError.text("El diagnóstico es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (diagnosis.length < 10) {
            diagnosisError.text("El diagnóstico debe tener al menos 10 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            diagnosisError.addClass("d-none");
        }

        // Validar Tratamiento
        let treatment = $("#treatment").val().trim();
        let treatmentError = $("#treatmentError");
        if (treatment === "") {
            treatmentError.text("Agregue al menos un medicamento para el tratamiento.").removeClass("d-none");
            isValid = false;
        } else {
            treatmentError.addClass("d-none");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    $("#patientProfileForm").submit(function (event) {
        let isValid = true;

        // Validación: Nombre
        let name = $("#name").val().trim();
        let nameError = $("#nameError");
        if (name === "") {
            nameError.text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            nameError.text("El nombre debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            nameError.addClass("d-none");
        }

        // Validación: Email
        let email = $("#email").val().trim();
        let emailError = $("#emailError");
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (email === "") {
            emailError.text("El email es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            emailError.text("Ingrese un email válido.").removeClass("d-none");
            isValid = false;
        } else {
            emailError.addClass("d-none");
        }

        // Validación: Tipo de Documento
       // Definir los límites según la base de datos
        const MIN_DOCUMENTO = 10000; // 5 dígitos
        const MAX_DOCUMENTO = 9999999999; // 10 dígitos

        // Validación: Documento (solo enteros positivos y dentro del rango)
        let documento = $("#documento").val().trim();
        let documentoError = $("#documentoError");

        if (
            documento === "" ||
            !/^\d+$/.test(documento) ||
            BigInt(documento) < MIN_DOCUMENTO ||
            BigInt(documento) > MAX_DOCUMENTO
        ) {
            documentoError.text("El documento debe ser un número válido de entre 5 y 10 dígitos.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }

       const MAX_TELEFONO = 999999999999999; // 15 dígitos (ajusta según el país)
       // Validación: Teléfono (solo enteros positivos y dentro del rango)
       let telefono = $("#telefono").val().trim();
       let telefonoError = $("#telefonoError");
       if (telefono === "" || !/^\d+$/.test(telefono) || BigInt(telefono) <= 0n || BigInt(telefono) > MAX_TELEFONO) {
           telefonoError.text("El teléfono debe ser un número válido y no mayor a 15 dígitos.").removeClass("d-none");
           isValid = false;
       } else {
           telefonoError.addClass("d-none");
       }




        // Validación: Fecha de Nacimiento
        let birthdate = $("#birthdate").val();
        let birthdateError = $("#birthdateError");
        if (!birthdate) {
            birthdateError.text("La fecha de nacimiento es obligatoria.").removeClass("d-none");
            isValid = false;
        } else {
            let birthDateObj = new Date(birthdate);
            let now = new Date();
            if (birthDateObj > now) {
                birthdateError.text("La fecha de nacimiento no puede ser en el futuro.").removeClass("d-none");
                isValid = false;
            } else {
                // Opcional: Verificar que no sea mayor a 120 años
                let age = now.getFullYear() - birthDateObj.getFullYear();
                let monthDiff = now.getMonth() - birthDateObj.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && now.getDate() < birthDateObj.getDate())) {
                    age--;
                }
                if (age > 120) {
                    birthdateError.text("Ingrese una fecha de nacimiento válida.").removeClass("d-none");
                    isValid = false;
                } else {
                    birthdateError.addClass("d-none");
                }
            }
        }

        // Validación: Género
        let gender = $("#gender").val();
        let genderError = $("#genderError");
        if (gender === "") {
            genderError.text("Seleccione un género.").removeClass("d-none");
            isValid = false;
        } else {
            genderError.addClass("d-none");
        }

        // Validación: Dirección
        let adress = $("#adress").val().trim();
        let adressError = $("#adressError");
        if (adress === "") {
            adressError.text("La dirección es obligatoria.").removeClass("d-none");
            isValid = false;
        } else if (adress.length < 5) {
            adressError.text("La dirección debe tener al menos 5 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            adressError.addClass("d-none");
        }

        // Si hay errores, evitamos que se envíe el formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    // Se asume que el formulario tiene el id "specialtyForm".
    // Si no lo tiene, agrégale un id a tu form: id="specialtyForm"
    $("#specialtyForm").submit(function (event) {
        let isValid = true;
        let name = $("#name").val().trim();

        // Validar que el nombre no esté vacío
        if (name === "") {
            $("#nameError").text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            // Validar que tenga al menos 3 caracteres
            $("#nameError").text("El nombre debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            // Si es válido, ocultamos el mensaje
            $("#nameError").addClass("d-none");
        }

        // Evitar el envío del formulario si hay algún error
        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    $("#specialtyForm").submit(function (event) {
        let isValid = true;
        let name = $("#name").val().trim();

        // Validación: Nombre no vacío
        if (name === "") {
            $("#nameError").text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            // Validación: Mínimo 3 caracteres
            $("#nameError").text("El nombre debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            $("#nameError").addClass("d-none");
        }

        // Prevenir el envío si existen errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});


$(document).ready(function () {
    $("#roleForm").submit(function (event) {
        let isValid = true;
        let name = $("#name").val().trim();

        // Validación: el nombre es obligatorio
        if (name === "") {
            $("#nameError").text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            // Validación: el nombre debe tener al menos 3 caracteres
            $("#nameError").text("El nombre debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            $("#nameError").addClass("d-none");
        }

        // Prevenir el envío del formulario si hay errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});
$(document).ready(function () {
    $("#registerForm").submit(function (event) {
        let isValid = true;

        // Validar Nombre
        let name = $("#name").val().trim();
        if (name === "") {
            $("#nameError").text("El nombre es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (name.length < 3) {
            $("#nameError").text("El nombre debe tener al menos 3 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            $("#nameError").addClass("d-none");
        }

        // Validar Correo Electrónico
        let email = $("#email").val().trim();
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
        if (email === "") {
            $("#emailError").text("El correo electrónico es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Ingrese un correo electrónico válido.").removeClass("d-none");
            isValid = false;
        } else {
            $("#emailError").addClass("d-none");
        }

        // Validar Tipo de Documento

        let documentType = $("#document_type").val().trim();
        if (documentType === "") {
            $("#documentTypeError").text("Seleccione el tipo de documento.").removeClass("d-none");
            isValid = false;
        } else {
            $("#documentTypeError").addClass("d-none");
        }

        // Validar Número de Documento (solo enteros positivos)
        const MIN_DOCUMENTO = 10000; // 5 dígitos
        const MAX_DOCUMENTO = 9999999999; // 10 dígitos

        // Validación: Documento (solo enteros positivos y dentro del rango)
        let documento = $("#documento").val().trim();
        let documentoError = $("#documentoError");

        if (
            documento === "" ||
            !/^\d+$/.test(documento) ||
            parseInt(documento) < MIN_DOCUMENTO ||
            parseInt(documento) > MAX_DOCUMENTO
        ) {
            documentoError.text("El documento debe ser un número válido de entre 5 y 10 dígitos.").removeClass("d-none");
            isValid = false;
        } else {
            documentoError.addClass("d-none");
        }

        const MAX_TELEFONO = 999999999999999; // 15 dígitos (ajusta según el país)
        // Validación: Teléfono (solo enteros positivos y dentro del rango)
        let telefono = $("#telefono").val().trim();
        let telefonoError = $("#telefonoError");
        if (telefono === "" || !/^\d+$/.test(telefono) || BigInt(telefono) <= 0n || BigInt(telefono) > MAX_TELEFONO) {
            telefonoError.text("El teléfono debe ser un número válido y no mayor a 15 dígitos.").removeClass("d-none");
            isValid = false;
        } else {
            telefonoError.addClass("d-none");
        }


        // Validar Fecha de Nacimiento
        let birthdate = $("#birthdate").val().trim();
        if (birthdate === "") {
            $("#birthdateError").text("La fecha de nacimiento es obligatoria.").removeClass("d-none");
            isValid = false;
        } else {
            let birthDateObj = new Date(birthdate);
            let now = new Date();
            if (birthDateObj > now) {
                $("#birthdateError").text("La fecha de nacimiento no puede ser en el futuro.").removeClass("d-none");
                isValid = false;
            } else {
                $("#birthdateError").addClass("d-none");
            }
        }

        // Validar Género
        let gender = $("#gender").val().trim();
        if (gender === "") {
            $("#genderError").text("El género es obligatorio.").removeClass("d-none");
            isValid = false;
        } else {
            $("#genderError").addClass("d-none");
        }

        // Validar Dirección
        let adress = $("#adress").val().trim();
        if (adress === "") {
            $("#adressError").text("La dirección es obligatoria.").removeClass("d-none");
            isValid = false;
        } else if (adress.length < 5) {
            $("#adressError").text("La dirección debe tener al menos 5 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            $("#adressError").addClass("d-none");
        }

        // Validar Contraseña
        let password = $("#password").val();
        if (password === "") {
            $("#passwordError").text("La contraseña es obligatoria.").removeClass("d-none");
            isValid = false;
        } else if (password.length < 6) {
            $("#passwordError").text("La contraseña debe tener al menos 6 caracteres.").removeClass("d-none");
            isValid = false;
        } else {
            $("#passwordError").addClass("d-none");
        }

        // Validar Confirmación de Contraseña
        let passwordConfirm = $("#password-confirm").val();
        if (passwordConfirm === "") {
            $("#passwordConfirmError").text("La confirmación de la contraseña es obligatoria.").removeClass("d-none");
            isValid = false;
        } else if (password !== passwordConfirm) {
            $("#passwordConfirmError").text("Las contraseñas no coinciden.").removeClass("d-none");
            isValid = false;
        } else {
            $("#passwordConfirmError").addClass("d-none");
        }

        // Prevenir el envío si hay errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});

$(document).ready(function() {
    $("#loginForm").submit(function(event) {
        let isValid = true;

        // Validar Email
        let email = $("#email").val().trim();
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
        if (email === "") {
            $("#emailError").text("El correo electrónico es obligatorio.").removeClass("d-none");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Ingrese un correo electrónico válido.").removeClass("d-none");
            isValid = false;
        } else {
            $("#emailError").addClass("d-none");
        }

        // Validar Contraseña
        let password = $("#password").val();
        if (password === "") {
            $("#passwordError").text("La contraseña es obligatoria.").removeClass("d-none");
            isValid = false;
        } else {
            $("#passwordError").addClass("d-none");
        }

        // Prevenir el envío si hay errores
        if (!isValid) {
            event.preventDefault();
        }
    });
});









