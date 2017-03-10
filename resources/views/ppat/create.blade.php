@extends('layout.dashboard')

@section('judul', 'Input PPAT')

@section('deskripsi', 'tambah daftar PPAT')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-edit"></i>
          <h3 class="box-title">Input PPAT</h3>
        </div>
        <div class="box-body">
          {!! Form::open([
            'url'     => route('ppat.store'), 
            'method'  => 'post',
            'class'   => 'box-body'
            ]) !!}

          @include('ppat._form')

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