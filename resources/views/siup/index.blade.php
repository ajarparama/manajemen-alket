@extends('layout.dashboard')

@section('judul', 'SIUP dan TDP')

@section('deskripsi', 'menampilkan daftar SIUP dan TDP')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        @if (Auth::user()->seksi == 8)
          <a href="#"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
        @else
          <button type="button" class="btn btn-primary disabled" >Tambah Data</button>
        @endif
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12" style="overflow-x: scroll;">
              <table class="table table-bordered dataTable" id="dataTableBuilder"></table>
            </div>
          </div> 

            <!-- Delete Modal -->
            <div class="modal fade" id="myModal-#" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Alket</h4>
                  </div>
                  <div class="modal-body">
                    Anda yakin ingin menghapus Alket dari ?
                  </div>
                  <div class="modal-footer">

                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>
@endsection