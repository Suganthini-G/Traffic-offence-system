var chart = new Chart(ctx, {
   type: 'line',
   data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr'],
      datasets: [{
         label: '# of votes',
         data: [1, 2, 3, 4]
      }]
   },
   options: {
      scales: {
         yAxes: [{
            ticks: {
               stepSize: 1
            }
         }]
      }
   }
});


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<canvas id="ctx"></canvas>