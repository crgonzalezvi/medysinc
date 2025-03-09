@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Atender Cita</h2>

    <!-- Agregamos un id al formulario para que el JS lo pueda detectar -->
    <form action="{{ route('appointments.storeMedicalHistory', $appointment->id) }}" method="POST" id="attendAppointmentForm">
        @csrf

        <div class="mb-3">
            <label for="diagnosis" class="form-label">Diagnóstico:</label>
            <textarea name="diagnosis" id="diagnosis" class="form-control" rows="5"></textarea>
            <!-- Contenedor para mostrar el error de Diagnóstico -->
            <small id="diagnosisError" class="text-danger d-none"></small>
        </div>

        <div class="mb-3">
            <label for="treatment" class="form-label">Tratamiento:</label>
            <input type="text" id="treatmentInput" class="form-control" list="medicamentos" placeholder="Escribe un medicamento y presiona Enter">
            <datalist id="medicamentos"></datalist>
            <div id="treatmentTags" class="mt-2"></div>
            <input type="hidden" name="treatment" id="treatment" value="">
            <!-- Contenedor para mostrar el error de Tratamiento -->
            <small id="treatmentError" class="text-danger d-none"></small>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Consulta</button>
    </form>
</div>

<!--
    El siguiente script es para la funcionalidad de etiquetas de tratamiento.
    Puedes dejarlo inline si es exclusivo de esta vista.
-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const treatmentInput = document.getElementById("treatmentInput");
        const datalist = document.getElementById("medicamentos");
        const treatmentTagsContainer = document.getElementById("treatmentTags");
        const hiddenInput = document.getElementById("treatment");
        let selectedTreatments = [];

        treatmentInput.addEventListener("input", function () {
            const searchQuery = this.value;
            if (searchQuery.length < 3) return;

            fetch(`https://cima.aemps.es/cima/rest/medicamentos?nombre=${searchQuery}`)
                .then(response => response.json())
                .then(data => {
                    datalist.innerHTML = "";
                    data.resultados.forEach(med => {
                        const option = document.createElement("option");
                        option.value = med.nombre;
                        datalist.appendChild(option);
                    });
                })
                .catch(error => console.error("Error obteniendo medicamentos:", error));
        });

        treatmentInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === ",") {
                event.preventDefault();
                addTreatmentTag(this.value.trim());
                this.value = "";
            }
        });

        function addTreatmentTag(text) {
            if (text === "" || selectedTreatments.includes(text)) return;
            selectedTreatments.push(text);
            updateHiddenInput();
            const tag = document.createElement("span");
            tag.classList.add("badge", "bg-primary", "me-2", "p-2");
            tag.textContent = text;
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.classList.add("btn-close", "ms-2");
            removeBtn.addEventListener("click", function () {
                treatmentTagsContainer.removeChild(tag);
                selectedTreatments = selectedTreatments.filter(t => t !== text);
                updateHiddenInput();
            });
            tag.appendChild(removeBtn);
            treatmentTagsContainer.appendChild(tag);
        }

        function updateHiddenInput() {
            hiddenInput.value = selectedTreatments.join(", ");
        }
    });
</script>

<!-- Incluir jQuery y tu archivo de validaciones (que contiene la lógica para mostrar errores) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
