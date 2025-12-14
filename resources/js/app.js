import './bootstrap';

import Chart from "chart.js/auto";



const canvas = document.getElementById("animalsChart");

if (canvas) {
    const labels = ["Jan",];

    const data = {
        labels: labels,
        datasets: [
            {
                label: "Animaux adoptés",
                data: [12, 18, 14, 20, 15, 10, 17],
                backgroundColor: "rgba(75, 192, 192, 0.5)",
                borderColor: "rgb(75, 192, 192)",
                borderWidth: 1,
            },
            {
                label: "Animaux arrivés",
                data: [8, 15, 10, 12, 9, 11, 13],
                backgroundColor: "rgba(255, 159, 64, 0.5)",
                borderColor: "rgb(255, 159, 64)",
                borderWidth: 1,
            },
            {
                label: "Animaux restants",
                data: [20, 23, 19, 22, 21, 20, 18],
                backgroundColor: "rgba(153, 102, 255, 0.5)",
                borderColor: "rgb(153, 102, 255)",
                borderWidth: 1,
            }
        ],
    };

    const config = {
        type: "bar",
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    new Chart(canvas, config);
}
