import Chart from "chart.js/auto";
import { Colors } from 'chart.js';

Chart.register(Colors);
var test = "zz";
//expect data from Laravel here

window.helloThere = function () { //example global JS run
    console.log('yow');
    console.log(test);
    console.log(gg);
};

window.download = function () {
    // create an image from the canvas
    var canvas = document.getElementById('zeChat');
    //console.log(canvas);
    // create link to the image
    var imageLink = document.createElement('a');
    // create a naming for the download imgae
    imageLink.download = 'canvas.png';
    // setting the quality of the image
    imageLink.href = canvas.toDataURL();
    // execute image download function
    imageLink.click();
};

window.downloadPDF = function () {
    // create an image from the canvas
    var canvas = document.getElementById('zeChat');
    // Create Image
    const canvasImage = canvas.toDataURL('image/jpeg', 1);
    //console.log(canvasImage);
    // Image must go to pdf 
    let pdf = new jsPDF('landscape');
    pdf.setFontSize(20);
    pdf.addImage(canvasImage, 'PNG', 15, 15, 280, 150);
    pdf.save('chart.pdf');
};

window.changeType = function (ct) {

    console.log(ct.value);

    if (ct.value === 'bar') {
        config.type = 'bar';
    }
    else if (ct.value === 'line') {
        config.type = 'line';
    }
    else if (ct.value === 'pie') {
        config.type = 'pie';
    }
    else if (ct.value === 'radar') {
        config.type = 'radar';
    }
    console.log(config.type);
    zeChat.destroy();
    zeChat = new Chart(
        document.getElementById('zeChat'),
        config
    );
};

const ctx = document.getElementById("zeChat");

//new Chart(ctx, {
var config = {
    type: chartType,
    data: {
        labels: x_value,
        datasets: [
            {
                label: y_label,
                data: data,
                borderWidth: 1,
                backgroundColor: [
                    'rgba(255, 26, 104, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(0, 0, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 26, 104, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(0, 0, 0, 1)'
                ],
            },
        ],
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: title,
            },
            plugin,
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
};
const plugin = {
    id: 'customCanvasBackgroundColor',
    beforeDraw: (chart, args, options) => {
        const { ctx } = chart;
        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = options.color || '#99ffff';
        ctx.fillRect(0, 0, chart.width, chart.height);
        ctx.restore();
    }
};
let zeChat = new Chart(
    document.getElementById('zeChat'),
    config
);