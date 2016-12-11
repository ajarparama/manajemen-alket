@extends('layout.dashboard')

@section('judul', 'Laporan PPAT')

@section('deskripsi', 'tambah laporan bulanan ppat')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-edit"></i>
          <h3 class="box-title">Input Laporan PPAT</h3>
        </div>
        <div class="box-body">
          {!! Form::open([
            'url'     => route('lapppat.store'), 
            'method'  => 'post',
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