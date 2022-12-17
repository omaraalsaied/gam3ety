
 

  const config1 = {
    type: 'line',
    data: data1,
    options: {}
  };

  const config2 = {
    type: 'doughnut',
    data: data2,
    options: {}
  };

  const config3 = {
  type: 'bar',
  data: data3,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
  };


  const config4 = {
  type: 'bar',
  data: data3,
  options: {
      indexAxis: 'y',
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
  };

  const config5 = {
    type: 'line',
    data: data5,
    options: {}
  };

  const myChart = new Chart(
    document.getElementById('myChart1'),
    config1
  );

  const myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );


  const myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );

  const myChart4 = new Chart(
    document.getElementById('myChart4'),
    config4
  );
  const myChart5 = new Chart(
    document.getElementById('myChart5'),
    config5
  );





//   let aaa = "2022-12-30";
// let bbb = aaa.split("-");
// console.log(bbb);








/*=================== maps =======================*/
