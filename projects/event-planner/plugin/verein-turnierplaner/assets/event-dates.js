document.addEventListener('DOMContentLoaded', function () {
    var startDate = document.querySelector('input[name="start_date"]');
    var endDate = document.querySelector('input[name="end_date"]');

    if (!startDate || !endDate) return;

    function syncMinimum() {
        if (startDate.value) {
            endDate.min = startDate.value;
        } else {
            endDate.removeAttribute('min');
        }
    }

    function prepareEndDate() {
        syncMinimum();

        if (startDate.value && !endDate.value) {
            endDate.value = startDate.value;
            endDate.dataset.vtpAutoDefault = '1';
        }
    }

    startDate.addEventListener('change', function () {
        syncMinimum();

        if (endDate.dataset.vtpAutoDefault === '1') {
            endDate.value = startDate.value;
        }
    });

    endDate.addEventListener('pointerdown', prepareEndDate);
    endDate.addEventListener('focus', prepareEndDate);
    endDate.addEventListener('input', function () {
        endDate.dataset.vtpAutoDefault = '0';
    });

    syncMinimum();
});
