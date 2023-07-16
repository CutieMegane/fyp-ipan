<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style type="text/css">
      .chartBox{
        width: 700px;
      }
  </style>
  <title>Document</title>
</head>
<body>
    <div class="chartBox">
      <canvas id="myChart"></canvas>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  const data = [30, 50, 75, 70, 60, 90];
  const backgroundcolor = [];

  for(i=0; i<data.length; i++){
    if(data[i] < 40){
      backgroundcolor.push('green')
    }

    if(data[i] >= 40 && data[i] < 70){
      backgroundcolor.push('yellow')
    }
    
    if(data[i] >= 70){
      backgroundcolor.push('red')
    }
  }

  console.log(backgroundcolor);

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: data,
        backgroundColor: backgroundcolor,
        borderColor: backgroundcolor,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</body>
</html>