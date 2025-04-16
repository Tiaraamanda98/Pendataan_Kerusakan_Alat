@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5 text-center">
                            <div class="stats-icon purple">
                                <i class="iconly-boldShow"></i>
                            </div>
                            <h4 class="text-muted font-extrabold">Pengaduan Baru</4>
                            <h6 class="font-semibold mb-0">{{ $pengaduanBaru }}</h6>
                            <a href="{{ route('pengaduan.baru') }}">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5 text-center">
                            <div class="stats-icon blue">
                                <i class="iconly-boldProfile"></i>
                            </div>
                            <h4 class="text-muted font-extrabold">Pengaduan Diproses</h4>
                            <h6 class="font-semibold mb-0">{{ $pengaduanDiproses }}</h6>
                            <a href="{{ route('pengaduan.diproses') }}">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5 text-center">
                            <div class="stats-icon green">
                                <i class="iconly-boldAdd-User"></i>
                            </div>
                            <h4 class="text-muted font-extrabold">Pengaduan Selesai</h4>
                            <h6 class="font-semibold mb-0">{{ $pengaduanSelesai }}</h6>
                            <a href="{{ route('pengaduan.selesai') }}">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-center">
                <h4>Bulan Terbanyak Terjadi Kerusakan</h4>
            </div>
            <div class="card-body">
            <canvas id="keluhanChart" style="height: 500px; width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</section>
</div>
@endsection
