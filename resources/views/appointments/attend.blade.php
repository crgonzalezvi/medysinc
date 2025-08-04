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

    // 🔍 EXTRAER principio activo para consulta en DailyMed
    const genericName = text.split(" ")[0].toLowerCase();

    fetch(`https://dailymed.nlm.nih.gov/dailymed/services/v2/drugnames.json?name=${genericName}`)
        .then(res => res.json())
        .then(data => {
            if (data.data && data.data.length > 0) {
                const info = `⚠️ Posibles contraindicaciones para "${genericName}".`;
                const alertDiv = document.createElement("div");
                alertDiv.classList.add("alert", "alert-warning", "mt-2");
                alertDiv.innerText = info;
                tag.appendChild(alertDiv);
            } else {
                const noInfo = document.createElement("div");
                noInfo.classList.add("alert", "alert-secondary", "mt-2");
                noInfo.innerText = `ℹ️ No se encontraron contraindicaciones para "${genericName}".`;
                tag.appendChild(noInfo);
            }
        })
        .catch(error => {
            console.error("Error consultando DailyMed:", error);
        });
}



        function fetchContraindicationsFromDailyMed(drugName) {
    const searchUrl = `https://dailymed.nlm.nih.gov/dailymed/services/v2/spls.json?drug_name=${encodeURIComponent(drugName)}`;

    fetch(searchUrl)
        .then(response => response.json())
        .then(data => {
            if (!data.data || data.data.length === 0) {
                showContraindicationsAlert(drugName, 'No se encontraron contraindicaciones en DailyMed.');
                return;
            }

            const setId = data.data[0].setid;

            const detailUrl = `https://dailymed.nlm.nih.gov/dailymed/services/v2/spls/${setId}.json`;

            return fetch(detailUrl);
        })
        .then(response => response?.json())
        .then(details => {
            if (!details || !details.data || !details.data.sections) return;

            const contraindicationsSection = details.data.sections.find(
                s => s.title && s.title.toLowerCase().includes('contraindications')
            );

            if (contraindicationsSection) {
                showContraindicationsAlert(drugName, contraindicationsSection.text);
            } else {
                showContraindicationsAlert(drugName, 'No se encontraron contraindicaciones específicas.');
            }
        })
        .catch(err => {
            console.warn(`Error consultando contraindicaciones para ${drugName}`, err);
        });
}

function showContraindicationsAlert(drug, message) {
    const alert = document.createElement("div");
    alert.classList.add("alert", "alert-warning", "mt-2");
    alert.innerHTML = `<strong>${drug}:</strong><br>${message}`;
    document.getElementById("treatmentTags").appendChild(alert);
}
// Validación del formulario al enviar


        function updateHiddenInput() {
            hiddenInput.value = selectedTreatments.join(", ");
        }
    });
</script>

<!-- Incluir jQuery y tu archivo de validaciones (que contiene la lógica para mostrar errores) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
