@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <div class="welcome-box">
            Selamat Datang, <strong>{{ Auth::user()->nama_instansi }}</strong>
        </div>
    </div>
<br>

    <div class="card mt-4 shadow">
       <div class="card-header text-center">
        <h5 class="mb-0">Bulan dengan Laporan Terbanyak</h5>
     </div>

     <div class="card-body">
         <canvas id="keluhanChart"></canvas>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  #keluhanChart {
    width: 100% !important;
    height: 500px !important; 
  }
</style>
<canvas id="keluhanChart"></canvas>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('keluhanChart').getContext('2d');
    console.log("Labels:", {!! json_encode($allMonths) !!});
    console.log("Data:", {!! json_encode($data) !!});
    
    var keluhanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($allMonths) !!}, 
            datasets: [{
                label: 'Jumlah Kerusakan',
                data: {!! json_encode($data) !!},
                backgroundColor: '#6c84cc',
                borderColor: '#6c84cc',
                borderWidth: 1,
                barThickness: 40, 
                minBarLength: 5 
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 5, 
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false 
                }
            }
        }
    });
  });
</script>

<style>
    .welcome-box {
        background: #485cbc;
        color: white;
        padding: 15px 0;
        font-size: 22px;
        font-weight: bold;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
