@extends('layout.dashboard')

@section('judul', 'Laporan PPAT')

@section('deskripsi', 'daftar laporan bulanan ppat')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        @if (Auth::user()->seksi == 8)
          <a href="{{ route('lapppat.create') }}"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
        @else
          <button type="button" class="btn btn-primary disabled" >Tambah Data</button>
        @endif
        </div>
        <div class="box-body">
          <table class="table table-bordered">
            <thead class="text-center">
              <tr>
                <th>No Surat</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Nama PPAT</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Terima</th>
                <th>No Agenda</th>
                <th>Jumlah <br> Data</th>
                <th>Nilai Data</th>
                <th>Jumlah <br> Alket</th>
                @if (Auth::user()->seksi == 8)
                <th>Opsi</th>
                @else
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($lapppats as $lapppat)
              <tr>
                <td>{{ $lapppat->no_surat }}</td>
                <td>{{ $nama_bulan[$lapppat->bulan - 1] }}</td>
                <td>{{ $lapppat->tahun }}</td>
                <td>{{ $lapppat->ppat->nama }}</td>
                <td>{{ date("d-m-Y", strtotime($lapppat->tgl_surat)) }}</td>
                <td>{{ date("d-m-Y", strtotime($lapppat->tgl_terima)) }}</td>
                <td>{{ $lapppat->no_agenda }}</td>
                <td>{{ $lapppat->jml_data }}</td>
                <td class="text-right">{{ number_format($lapppat->nilai_data, 0, "", ".") }}</td>
                <td>{{ $lapppat->jml_alket }}</td>
                @if (Auth::user()->seksi == 8)
                <td>
                  <div class="btn-group">
                    <a class="btn btn-xs btn-primary" href="{{ route('lapppat.edit', $lapppat->id) }}"><i class="fa fa-edit"></i> Edit</a>
                    <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal-{{$lapppat->id}}"><i class="fa fa-trash"></i> Hapus</button>
                  </div>
                </td>
                @else
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $lapppats->links() }}

          <!-- Delete Modal -->
          @if (Auth::user()->seksi == 8)
          @foreach ($lapppats as $lapppat)
          <div class="modal fade" id="myModal-{{$lapppat->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Hapus Laporan PPAT</h4>
                </div>
                <div class="modal-body">
                  Anda yakin ingin menghapus Laporan PPAT dari {{ $lapppat->ppat->nama }} bulan {{ $nama_bulan[$lapppat->bulan - 1] }} tahun {{ $lapppat->tahun }}?
                </div>
                <div class="modal-footer">
                {!! Form::model($lapppat, ['url' => route('lapppat.destroy', $lapppat->id) ,'method' => 'delete'] ) !!}
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                {!! Form::close()!!}
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection