import './bootstrap';
import 'bootstrap-table';

async function createChart() {
    const ctx = document.getElementById('car-chart');

    const response = await fetch(document.querySelector('meta[name="ajaxChartURL"]').getAttribute('content'));
    let data = await response.json();

    const carData = Object.values(data.data).map(item => item.car);
    const bicycleData = Object.values(data.data).map(item => item.bicycle);
    const publicTransportationData = Object.values(data.data).map(item => item.publictransportation);

    console.log(carData);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [
                {
                    label: 'Car',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    data: carData
                },
                {
                    label: 'Bike',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: bicycleData
                },
                {
                    label: 'Public Transportation',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    data: publicTransportationData
                }
            ]
        }
    })
}

createChart();
