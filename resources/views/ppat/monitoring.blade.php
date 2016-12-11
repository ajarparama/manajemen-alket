@extends('layout.dashboard')

@section('judul', 'Monitoring PPAT')

@section('deskripsi', 'monitoring kepatuhan pelaporan PPAT')

@section('content')
<!-- Area Dropdown -->
  <div class="callout callout-info pad no-print">
    {!! Form::open([
    'url'     => 'monitoring', 
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
      {!! Form::submit('Submit', ['class'=>'btn btn-success btn-trw']) !!} 
    </div>
    {!! Form::close() !!}
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
        @if ( ! count(Request::all()))
          Silakan pilih tahun terlebih dahulu
        @else
          <table class="table table-bordered">
            <thead class="text-center">
              <tr>
                <th>Nama</th>
                <th>JAN</th>
                <th>FEB</th>
                <th>MAR</th>
                <th>APR</th>
                <th>MEI</th>
                <th>JUN</th>
                <th>JUL</th>
                <th>AGU</th>
                <th>SEP</th>
                <th>OKT</th>
                <th>NOV</th>
                <th>DES</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ppats as $ppat)
              <tr>
                <td>{{ $ppat->nama }}</td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '1')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '2')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '3')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '4')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '5')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '6')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '7')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '8')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '9')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '10')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '11')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
                <td @if ($ppat->lapppat->where('tahun', '=', $tahun)->where('bulan', '=', '12')->count('bulan') === 1) bgcolor="#00a65a" @else bgcolor="#d2d6de" @endif ></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
function myFunction() {
    window.print();
}

@endsection