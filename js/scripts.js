document.addEventListener('DOMContentLoaded', function() {
    const totalPax = document.getElementById('totalPax');
    const adultosNac = document.getElementById('adultosNac');
    const adultosInt = document.getElementById('adultosInt');
    const infantesNac = document.getElementById('infantesNac');
    const infantesInt = document.getElementById('infantesInt');
    const transitoNac = document.getElementById('transitoNac');
    const transitoInt = document.getElementById('transitoInt');
    const conexionNac = document.getElementById('conexionNac');
    const conexionInt = document.getElementById('conexionInt');
    const exentosNac = document.getElementById('exentosNac');
    const exentosInt = document.getElementById('exentosInt');
    const totalNac = document.getElementById('totalNac');
    const totalInt = document.getElementById('totalInt');

    function updateTotalPax() {
        const totalNacional = parseFloat(adultosNac.value) + parseFloat(infantesNac.value) +
                              parseFloat(transitoNac.value) + parseFloat(conexionNac.value) +
                              parseFloat(exentosNac.value);
        const totalInternacional = parseFloat(adultosInt.value) + parseFloat(infantesInt.value) +
                                    parseFloat(transitoInt.value) + parseFloat(conexionInt.value) +
                                    parseFloat(exentosInt.value);

        totalNac.value = totalNacional;
        totalInt.value = totalInternacional;
        totalPax.value = totalNacional + totalInternacional;
    }

    function autoFillAircraftData() {
        const matricula = document.getElementById('matricula').value;

        fetch(`php/consultar_aeronave.php?matricula=${matricula}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('aeronave').value = data.Tipo_de_avion || '';
                    document.getElementById('aerolinea').value = data.AEROLINEA || '';
                    document.getElementById('maxPax').value = data.Max_Pax || '';
                    document.getElementById('factorOcup').value = data.FACTOR_OCUP || '';
                    document.getElementById('calf').value = data.CALIFICADOR || '';
                    document.getElementById('tipoLlegada').value = data.tipo_llegada || '';
                    document.getElementById('tipoSalida').value = data.tipo_salida || '';
                }
            })
            .catch(error => console.error('Error al obtener datos del avión:', error));
    }

    document.getElementById('matricula').addEventListener('blur', autoFillAircraftData);
    
    document.getElementById('adultosNac').addEventListener('input', updateTotalPax);
    document.getElementById('adultosInt').addEventListener('input', updateTotalPax);
    document.getElementById('infantesNac').addEventListener('input', updateTotalPax);
    document.getElementById('infantesInt').addEventListener('input', updateTotalPax);
    document.getElementById('transitoNac').addEventListener('input', updateTotalPax);
    document.getElementById('transitoInt').addEventListener('input', updateTotalPax);
    document.getElementById('conexionNac').addEventListener('input', updateTotalPax);
    document.getElementById('conexionInt').addEventListener('input', updateTotalPax);
    document.getElementById('exentosNac').addEventListener('input', updateTotalPax);
    document.getElementById('exentosInt').addEventListener('input', updateTotalPax);

    // Modal Functions
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    
    document.querySelectorAll('.close').forEach(button => {
        button.addEventListener('click', function() {
            closeModal(this.dataset.modal);
        });
    });
});
