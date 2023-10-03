const buscarBtn = document.getElementById('buscarBtn');
const placaInput = document.getElementById('placaInput');
const result = document.getElementById('result');

buscarBtn.addEventListener('click', function () {
    const placa = placaInput.value.trim().toUpperCase();
    // depois fazer a parte de buscar registros no backend v2
    result.textContent = `Placa do veículo: ${placa}`;
});