@extends('layout.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
@endsection


@section('judul', 'Media Massa')

@section('deskripsi', 'tambah alket media massa')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-edit"></i>
          <h3 class="box-title">Input Alket Media Massa</h3>
        </div>
        <div class="box-body">
          {!! Form::open([
            'url'     => route('mediamassa.store'), 
            'method'  => 'post',
            'class'   => 'box-body'
            ]) !!}

          @include('mediamassa._form')

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
</script>
<script src="{{ asset('js/summernote.min.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $('#deskripsi').summernote({
            height: 400,
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }
        });
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("deskripsi", file);
            $.ajax({
                data: data,
                type: "POST",
                url: "{{ route('mediamassa.store') }}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    editor.insertImage(welEditable, url);
                }
            });
        }
    });
  $(window).load(function(){
    $(":input").inputmask();
  });
</script>
@endsection