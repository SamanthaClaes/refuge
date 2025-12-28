import './bootstrap'
import Chart from 'chart.js/auto'

let animalsChart = null

function renderAnimalsChart() {
    const canvas = document.getElementById('animalsChart')
    if (!canvas) return

    const chartData = JSON.parse(canvas.dataset.chart)

    if (animalsChart) {
        animalsChart.destroy()
    }

    animalsChart = new Chart(canvas, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [
                { label: 'Animaux adoptés', data: chartData.adopted },
                { label: 'Animaux arrivés', data: chartData.arrived },
                { label: 'Animaux restants', data: chartData.remaining },
            ],
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true,
                ticks : {precision : 0}} },
        },
    })
}
document.addEventListener('DOMContentLoaded', renderAnimalsChart)
window.addEventListener('render-animals-chart', renderAnimalsChart)
