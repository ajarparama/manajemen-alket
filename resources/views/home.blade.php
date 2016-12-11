@extends('layout.dashboard')

@section('judul', 'Dashboard')

@section('deskripsi', 'Halo ' . Auth::user()->nama . '! Selamat datang di Dashboard.')

@section('content')
<div class="row">

  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Produksi Alket per Bulan</h3>
      </div>
      <div class="box-body">
        <div class="chart">
          <canvas id="chartAlket" width="780" height="360"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>{{ $widget_alket }}</h3>
        <p>Alket dari PPAT tahun ini</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-bulb"></i>
      </div>
    </div>
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{{ number_format($widget_nilai, 0, "", ".") }}</h3>
        <p>Nilai transaksi bisa dimanfaatkan tahun ini</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
    </div>
    <div class="small-box bg-teal">
      <div class="inner">
        <h3>{{ $widget_lap }}</h3>
        <p>Jumlah Laporan PPAT tahun ini</p>
      </div>
      <div class="icon">
        <i class="ion ion-document-text"></i>
      </div>
    </div>
  </div>

</div>
@endsection

@section('scripts')
</script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
var canvas = document.getElementById("chartAlket");
var ctx = canvas.getContext("2d");

var dat = {
    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    datasets: [
        {
            label: "Jumlah Data",
            borderColor: "rgba(57,204,204,0.5)",
            backgroundColor: "rgba(0,192,239,0.1)",
            pointBackgroundColor: "rgba(57,204,204,1)",
            pointRadius: 5,
            data: <?php echo $chart_data; ?>
        },
        {
            label: "Jumlah Alket",
            borderColor: "rgba(96,92,168,0.5)",
            backgroundColor: "rgba(0,192,239,0.1)",
            pointBackgroundColor: "rgba(96,92,168,1)",
            pointRadius: 5,
            data: <?php echo $chart_alket; ?>
        }
    ]
};


var myNewChart = new Chart(ctx , {
    type: "line",
    data: dat, 
    options: {
                responsive: true,
                tooltips: {
                    mode: 'x-axis',
                }
            }
});
</script>
@endsection