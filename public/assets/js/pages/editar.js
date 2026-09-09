document.addEventListener('DOMContentLoaded', function () {
    const preview = document.getElementById('previewContainer');
    if (preview && document.querySelector('.preview-box')) {
        preview.style.display = 'block';
    }

    const selectedArea = document.body.dataset.selectedArea;
    const selectedMoeda = document.body.dataset.selectedMoeda;

    const areaEl = document.getElementById('area');
    const moedaEl = document.getElementById('moeda');

    if (areaEl && selectedArea) {
        areaEl.value = selectedArea;
    }

    if (moedaEl && selectedMoeda) {
        moedaEl.value = selectedMoeda;
    }
});
