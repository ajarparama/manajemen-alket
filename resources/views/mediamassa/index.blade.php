@extends('layout.dashboard')

@section('judul', 'Media Massa')

@section('deskripsi', 'menampilkan alket dari media massa')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
            <a href="{{ route('mediamassa.create') }}"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
        </div>
      </div>
      <ul class="timeline">
        <li class="time-label">
          <span class="bg-teal">
            14 Des 2016
          </span>
        </li>
        <li>
          <i class="fa fa-envelope bg-blue"></i>
          <div class="timeline-item">
            <span class="time">
              <i class="fa fa-clock-o">
                12:05
              </i>
            </span>
            <h3 class="timeline-header">
              Borneo News, edisi Rabu 14 Desember 2016
            </h3>
            <div class="timeline-body">
              Isi di sini
            </div>
            <div class="timeline-footer">
              <a href="#" class="btn btn-primary btn-xs">Edit</a>
              <a href="#" class="btn btn-danger btn-xs">Delete</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
@endsection