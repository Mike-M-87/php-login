<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Page</title>
</head>
<body>
    
    <h1>Stream Results</h1>
    <div id="polldata"></div>
    <table>
        <tr>
            <th>Selection</th>
            <th>Votes</th>
        </tr>

        <tbody id="ok">

        </tbody>
    </table>

    <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function shout(){
        var xmlhttp= new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
            if (this.status==200) {
                document.getElementById("ok").innerHTML = this.responseText;
            }
        }

        xmlhttp.open("GET","getPollingProgress.php");
        xmlhttp.send();
    }

    setInterval(() => {
        shout()
    }, 10);

  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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

</html>