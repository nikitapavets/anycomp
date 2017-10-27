import Chart from 'chart.js';
import { months, requests } from '../config';

export default class Statistics {
  repairs(container) {
    fetch(requests.repairs)
    .then(response => response.json())
    .then(repairs => {
      this.makeChart(container, 'Колличество ремонтов за 2017 г.', repairs[2017]);
      container.parentNode.classList.remove('loading');
    });
  }

  makeChart(container, label, data) {
    new Chart(container, {
      type: 'line',
      data: {
        datasets: [
          {
            label,
            data,
          },
        ],
        labels: months.slice(0, data.length),
      },
    });
  }
}
