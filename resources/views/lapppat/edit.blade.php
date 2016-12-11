@extends('layout.dashboard')

@section('judul', 'Edit Laporan PPAT')

@section('deskripsi', '')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-edit"></i>
          <h3 class="box-title">Edit Laporan PPAT</h3>
        </div>
        <div class="box-body">
          {!! Form::model($lapppat, [
            'url'     => route('lapppat.update', $lapppat->id), 
            'method'  => 'put',
            'class'   => 'box-body'
            ]) !!}

          @include('lapppat._form')

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
</script>
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script>

  $(window).load(function(){
    $(":input").inputmask();
  });
</script>
@endsection