@extends('layout.dashboard')

@section('judul', 'Laporan Triwulanan PPAT')

@section('deskripsi', 'cetak laporan')

@section('content')
  <!-- Area Dropdown -->
  <div class="callout callout-info pad no-print">
    {!! Form::open([
    'url'     => 'cetak-laporan', 
    'method'  => 'get',
    'class'   => 'box-body'
    ]) !!}
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          {{ Form::label('tahun', 'Pilih Tahun') }}
          <select name="tahun" id="tahun" class="form-control">
            @for ($i = 2014; $i <= date('Y'); $i++)
            <option value="{{ $i }}" @if (Request::get('tahun') == $i) selected="selected" @endif >{{ $i }}</option>
            @endfor
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          {{ Form::label('triwulan', 'Pilih Triwulan') }}
          <select name="triwulan" id="triwulan" class="form-control"">
            <option value="1" @if (Request::get('triwulan') == 1) selected="selected" @endif >Triwulan I</option>
            <option value="2" @if (Request::get('triwulan') == 2) selected="selected" @endif >Triwulan II</option>
            <option value="3" @if (Request::get('triwulan') == 3) selected="selected" @endif >Triwulan III</option>
            <option value="4" @if (Request::get('triwulan') == 4) selected="selected" @endif >Triwulan IV</option>
          </select>
        </div>
      </div>
          {!! Form::submit('Submit', ['class'=>'btn btn-success btn-trw']) !!} 
    </div>
    {!! Form::close() !!}
  </div>

  @if ( ! count(Request::all()))
  <div class="box">
    <div class="box-body">
      Silakan pilih tahun dan bulan terlebih dahulu.
    </div>
  </div>
  @else
  <!-- Area Laporan -->
  <section class="lap-trw">
    <!-- Judul -->
    <div class="row kop-surat">

      <div class="col-xs-12">

        <div class="col-xs-6">
          <div class="kop-logo">
            <img src="{{ asset('img/kop-logo.png') }}" alt="kop-logo">
          </div>
          <div class="kop-judul">
            <p>
              KEMENTERIAN KEUANGAN REPUBLIK INDONESIA <br>
              DIREKTORAT JENDERAL PAJAK <br>
              KANTOR WILAYAH  DJP KALIMANTAN SELATAN DAN TENGAH <br>
              KANTOR PELAYANAN PAJAK PRATAMA PANGKALAN BUN <br>
            </p>
          </div>
        </div>

        <div class="col-xs-6 kepada">
          <div class="col-xs-2 yth text-right">
            <p>Yth.</p>
          </div>
          <div class="col-xs-10 kakanwil text-left">
            <p>Kepala Kantor Wilayah DJP Kalimantan Selatan dan Tengah</p>
            <p>Banjarmasin</p>
          </div>
        </div>

      </div>

      <div class="col-xs-12 text-center">
        <p>
          REKAPITULASI LAPORAN BULANAN PPAT <br>
          {{ $trw . " TAHUN " . $tahun }} <br>
        </p>
      </div>

    </div>

    <table class="table table-lap-trw">
      <thead class="text-center">
        <tr>
          <th rowspan=3>NO</th>
          <th rowspan=3>KABUPATEN/KOTA/NAMA PPAT</th>
          <th colspan=6>TRANSAKSI</th>
          <th colspan=3>TRANSAKSI YG DPT DIMANFAATKAN</th>
          <th rowspan=3>KETERANGAN</th>
        </tr>
        <tr>
          <th colspan=2>TRIWULAN LALU</th>
          <th colspan=2>TRIWULAN INI</th>
          <th colspan=2>S.D. TRIWULAN INI</th>
          <th rowspan=2>TRIWULAN LALU</th>
          <th rowspan=2>TRIWULAN INI</th>
          <th rowspan=2>S.D. TRIWULAN INI</th>
        </tr>
        <tr>
          <th>JUMLAH</th>
          <th>NILAI <br> Rp 000,-</th>
          <th>JUMLAH</th>
          <th>NILAI <br> Rp 000,-</th>
          <th>JUMLAH</th>
          <th>NILAI <br> Rp 000,-</th>
        </tr>
        <tr>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
          <th>7</th>
          <th>8</th>
          <th>9</th>
          <th>10</th>
          <th>11</th>
          <th>12</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th></th>
          <th><u><strong>KAB. KOTAWARINGIN BARAT</strong></u></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($ppatkobars as $index => $ppatkobar)
          <tr>
            <td>{{ $index +1 }}</td>
            <td>{{ $ppatkobar->nama }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_alket') }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_alket') }}</td>
            <td>{{ $ppatkobar->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_alket') }}</td>
            <td>-</td>
          </tr>
        @endforeach
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH</td>
          <td>{{ $kobarjml34->sum('jml_data') }}</td>
          <td>{{ number_format($kobarjml34->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $kobarjml56->sum('jml_data') }}</td>
          <td>{{ number_format($kobarjml56->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $kobarjml78->sum('jml_data') }}</td>
          <td>{{ number_format($kobarjml78->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $kobarjml34->sum('jml_alket') }}</td>
          <td>{{ $kobarjml56->sum('jml_alket') }}</td>
          <td>{{ $kobarjml78->sum('jml_alket') }}</td>
          <td>-</td>
        </tr>
        <tr>
          <th></th>
          <th><u><strong>KAB. LAMANDAU</strong></u></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($ppatlamandaus as $index => $ppatlamandau)
          <tr>
            <td>{{ $index +1 }}</td>
            <td>{{ $ppatlamandau->nama }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_alket') }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_alket') }}</td>
            <td>{{ $ppatlamandau->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_alket') }}</td>
            <td>-</td>
          </tr>
        @endforeach
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH</td>
          <td>{{ $lamandaujml34->sum('jml_data') }}</td>
          <td>{{ number_format($lamandaujml34->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $lamandaujml56->sum('jml_data') }}</td>
          <td>{{ number_format($lamandaujml56->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $lamandaujml78->sum('jml_data') }}</td>
          <td>{{ number_format($lamandaujml78->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $lamandaujml34->sum('jml_alket') }}</td>
          <td>{{ $lamandaujml56->sum('jml_alket') }}</td>
          <td>{{ $lamandaujml78->sum('jml_alket') }}</td>
          <td>-</td>
        </tr>

        <tr>
          <th></th>
          <th><u><strong>KAB. SUKAMARA</strong></u></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        @foreach ($ppatsukamaras as $index => $ppatsukamara)
          <tr>
            <td>{{ $index +1 }}</td>
            <td>{{ $ppatsukamara->nama }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_alket') }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_alket') }}</td>
            <td>{{ $ppatsukamara->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_alket') }}</td>
            <td>-</td>
          </tr>
        @endforeach
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH</td>
          <td>{{ $sukamarajml34->sum('jml_data') }}</td>
          <td>{{ number_format($sukamarajml34->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $sukamarajml56->sum('jml_data') }}</td>
          <td>{{ number_format($sukamarajml56->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $sukamarajml78->sum('jml_data') }}</td>
          <td>{{ number_format($sukamarajml78->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $sukamarajml34->sum('jml_alket') }}</td>
          <td>{{ $sukamarajml56->sum('jml_alket') }}</td>
          <td>{{ $sukamarajml78->sum('jml_alket') }}</td>
          <td>-</td>
        </tr>
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH KESELURUHAN</td>
          <td>{{ $alljml34->sum('jml_data') }}</td>
          <td>{{ number_format($alljml34->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $alljml56->sum('jml_data') }}</td>
          <td>{{ number_format($alljml56->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $alljml78->sum('jml_data') }}</td>
          <td>{{ number_format($alljml78->sum('nilai_data'), 0, "", ".") }}</td>
          <td>{{ $alljml34->sum('jml_alket') }}</td>
          <td>{{ $alljml56->sum('jml_alket') }}</td>
          <td>{{ $alljml78->sum('jml_alket') }}</td>
          <td>-</td>
        </tr>

      </tbody>
    </table>

    <div class="row">
      <div class="col xs-4 col-xs-offset-8">
        <p>Pangkalan Bun, {{ date('d M Y') }} <br>
          @if (empty($nama_ttd)) Kepala Kantor, @else Plh. Kepala Kantor, @endif
          <br><br><br><br>
          <strong>@if (empty($nama_ttd)) Artiek Purnawestri @else {{ $nama_ttd }} @endif</strong><br>
          NIP @if (empty($nip_ttd)) 196911231995032001 @else {{ $nip_ttd }} @endif
        </p>
      </div>
    </div>

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-xs-12">
        <button type="button" onclick="myFunction()" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#edit" style="margin-right: 5px;"><i class="fa fa-pencil"></i> Edit Penanda Tangan</button>
      </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Penanda Tangan</h4>
          </div>
          <div class="modal-body">
          <form role="form" method="GET" action="{{ url('cetak-laporan') . '?' . http_build_query(['tahun' => 4]) }}">
            <div class="row">
              <div class="col-xs-12">
                <div class="form-group">
                  {{ Form::label('nama_ttd', 'Nama Penanda Tangan') }}
                  {{ Form::text('nama_ttd', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nama Penanda Tangan')) }}
                </div>
                <div class="form-group">
                  {{ Form::label('nip_ttd', 'NIP Penanda Tangan') }}
                  {{ Form::text('nip_ttd', null, array('class' => 'form-control', 'placeholder'=> 'Masukan NIP Penanda Tangan')) }}
                </div>
                <input type="hidden" name="tahun" value="{{ $tahun }}">
                <input type="hidden" name="triwulan" value="{{ $triwulan }}">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
          </div>
          </form>
        </div>
      </div>
    </div>

  </section>
  @endif
@endsection

@section('scripts')
function myFunction() {
    window.print();
}

@endsection