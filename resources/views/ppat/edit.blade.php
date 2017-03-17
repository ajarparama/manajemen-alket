@extends('layout.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

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
          {!! Form::model($ppat, [
            'url'     => route('ppat.update', $ppat->npwp), 
            'method'  => 'put',
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
<script src="{{ asset('js/selectize.min.js') }}"></script>
<script>
  $(function () {
    $(":input").inputmask();
    $("#kabupaten").selectize({
    create: true,
    sortField: {
        field: 'text',
        direction: 'asc'
    },
    dropdownParent: 'body'
    });

  });

</script>
@endsection