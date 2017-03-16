@extends('layout.dashboard')

@section('judul', 'Daftar PPAT')

@section('deskripsi', 'menampilkan daftar PPAT')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        @if (Auth::user()->seksi == 8)
          <a href="{{ route('ppat.create') }}"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
        @else
          <button type="button" class="btn btn-primary disabled" >Tambah Data</button>
        @endif
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12" style="overflow-x: scroll;">
              <table class="table table-bordered dataTable" id="dataTableBuilder">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NPWP</th>
                    <th>Alamat</th>
                    <th>No. Telp.</th>
                    <th>No. HP</th>
                    <th>Email</th>
                    <th>Kabupaten</th>
                    @if (Auth::user()->seksi == 8)
                    <th>Opsi</th>
                    @else
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($ppats as $index => $ppat)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $ppat->nama }}</td>
                    <td>{{ $ppat->npwp }}</td>
                    <td>{{ $ppat->alamat }}</td>
                    <td>{{ $ppat->no_telp }}</td>
                    <td>{{ $ppat->no_hp }}</td>
                    <td>{{ $ppat->email }}</td>
                    <td>{{ $ppat->kabupaten }}</td>
                    @if (Auth::user()->seksi == 8)
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-xs btn-primary" href="{{ route('ppat.edit', $ppat->npwp) }}"><i class="fa fa-edit"></i> Edit</a>
                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deletePPAT-{{$ppat->npwp}}"><i class="fa fa-trash"></i> Hapus</button>
                      </div>
                    </td>
                    @else
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div> 
          
          @foreach ($ppats as $ppat)
            <!-- Delete Modal -->
            <div class="modal fade" id="deletePPAT-{{$ppat->npwp}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deletePPATLabel">Hapus Alket</h4>
                  </div>
                  <div class="modal-body">
                    Anda yakin ingin menghapus {{$ppat->nama}} dari daftar PPAT?
                  </div>
                  <div class="modal-footer">
                    {!! Form::model($ppat, ['url' => route('ppat.destroy', $ppat->npwp) ,'method' => 'delete'] ) !!}
                      <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                    {!! Form::close()!!}
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
@endsection

@section ('scripts')

  $(function () {
    $('#dataTableBuilder').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

@endsection