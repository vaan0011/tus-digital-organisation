document.addEventListener('DOMContentLoaded', function () {
    var startDate = document.querySelector('input[name="start_date"]');
    var endDate = document.querySelector('input[name="end_date"]');

    function formatLocalDate(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    function addDays(value, days) {
        if (!value) return '';
        var date = new Date(value + 'T00:00:00');
        if (isNaN(date.getTime())) return '';
        date.setDate(date.getDate() + days);
        return formatLocalDate(date);
    }

    function syncMinimum() {
        if (!startDate || !endDate) return;
        if (startDate.value) {
            endDate.min = startDate.value;
        } else {
            endDate.removeAttribute('min');
        }
    }

    function prepareEndDate() {
        if (!startDate || !endDate) return;
        syncMinimum();

        if (startDate.value && !endDate.value) {
            endDate.value = startDate.value;
            endDate.dataset.vtpAutoDefault = '1';
        }
    }

    function suggestedEventDay(input) {
        var dayDates = Array.prototype.slice.call(
            document.querySelectorAll('#vtp-event-days .vtp-day-date')
        );
        var index = dayDates.indexOf(input);

        for (var i = index - 1; i >= 0; i--) {
            if (dayDates[i].value) {
                return addDays(dayDates[i].value, 1);
            }
        }

        return startDate && startDate.value ? startDate.value : '';
    }

    function applyEventDayDefault(input) {
        if (!input || input.value) return;
        var suggestion = suggestedEventDay(input);
        if (!suggestion) return;

        input.value = suggestion;
        input.dataset.vtpAutoDefault = '1';
        input.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function defaultNewestEventDay() {
        var dayDates = document.querySelectorAll('#vtp-event-days .vtp-day-date');
        if (!dayDates.length) return;
        applyEventDayDefault(dayDates[dayDates.length - 1]);
    }

    if (startDate && endDate) {
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
    }

    document.addEventListener('click', function (event) {
        if (event.target.id === 'vtp-add-day') {
            // Der bestehende Event-Ablauf erzeugt den neuen Tag im selben Click-Event.
            // Den Default direkt danach setzen, bevor der Nutzer den nativen Picker öffnet.
            window.setTimeout(defaultNewestEventDay, 0);
        }
    });

    document.addEventListener('input', function (event) {
        if (event.target.matches('#vtp-event-days .vtp-day-date')) {
            event.target.dataset.vtpAutoDefault = '0';
        }
    });
});
