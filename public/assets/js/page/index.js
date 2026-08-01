"use strict";

var myChartEl = document.getElementById("myChart");
if (myChartEl) {
  var labels = typeof months !== 'undefined' ? months : ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var data = typeof gajiPerBulan !== 'undefined' ? gajiPerBulan : [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

  var ctx = myChartEl.getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Total Gaji',
        data: data,
        borderWidth: 2,
        backgroundColor: '#6777ef',
        borderColor: '#6777ef',
        borderWidth: 2.5,
        pointBackgroundColor: '#ffffff',
        pointRadius: 4
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            drawBorder: false,
            color: '#f2f2f2',
          },
          ticks: {
            beginAtZero: true,
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          }
        }],
        xAxes: [{
          gridLines: {
            display: false
          }
        }]
      },
    }
  });
}

var balance_chart_el = document.getElementById("balance-chart");
if (balance_chart_el) {
  var balance_chart = balance_chart_el.getContext('2d');
  var balance_chart_bg_color = balance_chart.createLinearGradient(0, 0, 0, 70);
  balance_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
  balance_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

  new Chart(balance_chart, {
    type: 'line',
    data: {
      labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
      datasets: [{
        label: 'Balance',
        data: [50, 61, 80, 50, 72, 52, 60, 41, 30, 45, 70, 40, 93, 63, 50, 62],
        backgroundColor: balance_chart_bg_color,
        borderWidth: 3,
        borderColor: 'rgba(63,82,227,1)',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
        pointRadius: 3,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
      },
    }
  });
}

var sales_chart_el = document.getElementById("sales-chart");
if (sales_chart_el) {
  var sales_chart = sales_chart_el.getContext('2d');
  var sales_chart_bg_color = sales_chart.createLinearGradient(0, 0, 0, 80);
  sales_chart_bg_color.addColorStop(0, 'rgba(63,82,227,.2)');
  sales_chart_bg_color.addColorStop(1, 'rgba(63,82,227,0)');

  new Chart(sales_chart, {
    type: 'line',
    data: {
      labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018', '26-07-2018', '27-07-2018', '28-07-2018', '29-07-2018', '30-07-2018', '31-07-2018'],
      datasets: [{
        label: 'Sales',
        data: [70, 62, 44, 40, 21, 63, 82, 52, 50, 31, 70, 50, 91, 63, 51, 60],
        borderWidth: 2,
        backgroundColor: sales_chart_bg_color,
        borderWidth: 3,
        borderColor: 'rgba(63,82,227,1)',
        pointBorderWidth: 0,
        pointBorderColor: 'transparent',
        pointRadius: 3,
        pointBackgroundColor: 'transparent',
        pointHoverBackgroundColor: 'rgba(63,82,227,1)',
      }]
    },
    options: {
      layout: {
        padding: {
          bottom: -1,
          left: -1
        }
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            beginAtZero: true,
            display: false
          }
        }],
        xAxes: [{
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false
          }
        }]
      },
    }
  });
}

var carousel = document.getElementById("products-carousel");
if (carousel && typeof $ !== 'undefined' && $.fn.owlCarousel) {
  $("#products-carousel").owlCarousel({
    items: 3,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    loop: true,
    responsive: {
      0: {
        items: 2
      },
      768: {
        items: 2
      },
      1200: {
        items: 3
      }
    }
  });
}
