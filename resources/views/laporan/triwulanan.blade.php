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
              {{ strtoupper($array_settings[4]) }} <br>
              {{ strtoupper($array_settings[0]) }} <br>
            </p>
          </div>
        </div>

        <div class="col-xs-6 kepada">
          <div class="col-xs-2 yth text-right">
            <p>Yth.</p>
          </div>
          <div class="col-xs-10 kakanwil text-left">
            <p>Kepala {{ $array_settings[4] }}</p>
            <p>{{ $array_settings[5] }}</p>
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
        @for ($i=0; $i<count($wilayahs); $i++)
        <tr>
          <th></th>
          <th><u><strong>KAB. {{ strtoupper($wilayahs[$i]) }}</strong></u></th>
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
        @foreach ($ppats[$i] as $index => $ppat)
          <tr>
            <td>{{ $index +1 }}</td>
            <td>{{ $ppat->nama }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_data') }}</td>
            <td>{{ number_format($ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_data') }}</td>
            <td>{{ number_format($ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('nilai_data'), 0, "", ".") }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_lalu)->sum('jml_alket') }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $trw_ini)->sum('jml_alket') }}</td>
            <td>{{ $ppat->lapppat->where('tahun', '=', $tahun)->whereIn('bulan', $sd_trw_ini)->sum('jml_alket') }}</td>
            <td>-</td>
          </tr>
        @endforeach
        
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH</td>
          <td>{{ $jml_trw_lalus[$i] }}</td>
          <td>{{ number_format($nilai_trw_lalus[$i], 0, "", ".") }}</td>
          <td>{{ $jml_trw_inis[$i] }}</td>
          <td>{{ number_format($nilai_trw_inis[$i], 0, "", ".") }}</td>
          <td>{{ $jml_sd_trw_inis[$i] }}</td>
          <td>{{ number_format($nilai_sd_trw_inis[$i], 0, "", ".") }}</td>
          <td>{{ $alket_trw_lalus[$i] }}</td>
          <td>{{ $alket_trw_inis[$i] }}</td>
          <td>{{ $alket_sd_trw_inis[$i] }}</td>
          <td>-</td>
        </tr>

        @endfor
        <tr class="total">
          <td></td>
          <td class="text-center">JUMLAH KESELURUHAN</td>
          <td>{{ array_sum($jml_trw_lalus) }}</td>
          <td>{{ number_format(array_sum($nilai_trw_lalus), 0, "", ".") }}</td>
          <td>{{ array_sum($jml_trw_inis) }}</td>
          <td>{{ number_format(array_sum($nilai_trw_inis), 0, "", ".") }}</td>
          <td>{{ array_sum($jml_sd_trw_inis) }}</td>
          <td>{{ number_format(array_sum($nilai_sd_trw_inis), 0, "", ".") }}</td>
          <td>{{ array_sum($alket_trw_lalus) }}</td>
          <td>{{ array_sum($alket_trw_inis) }}</td>
          <td>{{ array_sum($alket_sd_trw_inis) }}</td>
          <td>-</td>
        </tr>

      </tbody>

    </table>

    <div class="row">
      <div class="col xs-4 col-xs-offset-8">
        <p>{{ $array_settings[1] }}, {{ date('d M Y') }} <br>
          @if (empty($nama_ttd)) Kepala Kantor, @else Plh. Kepala Kantor, @endif
          <br><br><br><br>
          <strong>@if (empty($nama_ttd)) {{ $array_settings[2] }} @else {{ $nama_ttd }} @endif</strong><br>
          NIP @if (empty($nip_ttd)) {{ $array_settings[3] }} @else {{ $nip_ttd }} @endif
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