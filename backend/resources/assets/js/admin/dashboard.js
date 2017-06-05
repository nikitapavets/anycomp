(() => {

    $.getJSON('/api/repairs', (response) => {

        let data = [];
        $.each(response,  (year, months) => {
            data[year] = [];
            $.each(months, (month, repairCount) => {
                data[year].unshift(repairCount)
            });
        });

        const months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        const repairChart = document.getElementById('repairChart');
        const myLineChart = new Chart(repairChart, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Колличество клиентов за 2017 г.',
                    data: data[2017]
                }],
                labels: months.slice(0, data[2017].length)
            },
            options: {}
        });
    });

})();