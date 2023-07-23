import Chart from "chart.js/auto";

var test = "zz";
//expect data from Laravel here

window.helloThere = function (){ //example global JS run
    console.log('yow');
    console.log(test);
    console.log(gg);
};

const ctx = document.getElementById("zeChat");

new Chart(ctx, {
    type: chartType,
    data: {
        labels: x_value,
        datasets: [
            {
                label: y_label,
                data: data,
                borderWidth: 1,
            },
        ],
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: title,
            },
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: x_label,
                    align: "end",
                },
            },
            y: {
                title: {
                    display: true,
                    text: y_label,
                    align: "end",
                },
                beginAtZero: true,
            },
        },
    },
});