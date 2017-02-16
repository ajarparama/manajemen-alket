@extends('layout.dashboard')

@section('judul', 'Daftar Alket')

@section('deskripsi', 'menampilkan alket yang sudah diinput')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
        @if (Auth::user()->seksi == 8)
          <a href="{{ route('alket.create') }}"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
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
            @foreach ($alkets as $alket)
            <div class="modal fade" id="myModal-{{$alket->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Alket</h4>
                  </div>
                  <div class="modal-body">
                    Anda yakin ingin menghapus Alket dari {{ $alket->nama }}?
                  </div>
                  <div class="modal-footer">
                  {!! Form::model($alket, ['url' => route('alket.destroy', $alket->id) ,'method' => 'delete'] ) !!}
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
</script>
<script src="{{ asset('/js/handlebars-v4.0.5.js') }}"></script>
<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td style="width: 200px;">Jenis Transaksi:</td>
            <td>@{{jns_transaksi}}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Sumber Data:</td>
            <td>@{{sumber}}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Disposisi:</td>
            <td>@{{{seksi}}}</td>
        </tr>
    </table>
</script>
<script>
var template = Handlebars.compile($("#details-template").html());

var table = $('#dataTableBuilder').DataTable({
  "serverSide":true,
  "processing":true,
  "ajax": "{{ route('alket.index') }}",
  "autoWidth":false,
  "language" : {
                "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ baris",
                "lengthMenu":     "_MENU_ baris ditampilkan",
                "search":         "Cari:",
                "paginate" : {
                  "previous" : "<",
                  "next" : ">",
                  "last" : ">>",
                  "first" : "<<",
                  "page" : "Halaman ke-",
                  "pageOf" : "dari"
                }
              },
  "order": [ [0, 'desc'] ],
  "columns":[
    {"data":"id",
      "name":"id",
      "title":"ID",
      "orderable":true,
      "visible":false,
      "searchable":false},
    {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": ''
            },
    {"data":"nama_penjual",
      "name":"nama_penjual",
      "title":"Nama Penjual",
      "orderable":true,
      "searchable":true},
    {"data": "npwp_penjual",
      "name":"npwp_penjual",
      "title":"NPWP Penjual",
      "orderable":true,
      "searchable":true,
      "render": function ( data, type, row ) {
          var str = data.toString()
          var pad = "000000000000000"
          var ans = pad.substring(0, pad.length - str.length) + str
          var npwp = ans.substring(0,2)+"."+ans.substring(2,5)+"."+ans.substring(5,8)+"."+ans.substring(8,9)+"-"+ans.substring(9,12)+"."+ans.substring(12,15) ;
        return npwp;
        }
      },
    {"data":"nama_pembeli",
      "name":"nama_pembeli",
      "title":"Nama Pembeli",
      "orderable":true,
      "searchable":true},
    {"data": "npwp_pembeli",
      "name":"npwp_pembeli",
      "title":"NPWP Pembeli",
      "orderable":true,
      "searchable":true,
      "render": function ( data, type, row ) {
          var str = data.toString()
          var pad = "000000000000000"
          var ans = pad.substring(0, pad.length - str.length) + str
          var npwp = ans.substring(0,2)+"."+ans.substring(2,5)+"."+ans.substring(5,8)+"."+ans.substring(8,9)+"-"+ans.substring(9,12)+"."+ans.substring(12,15) ;
        return npwp;
        }
      },
    {"data":"nilai_data",
      "name":"nilai_data",
      "title":"Nilai Data",
      "orderable":true,
      "searchable":true,
      "render": $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' )
      },
    {"data":"nop",
      "name":"nop",
      "title":"NOP",
      "orderable":true,
      "searchable":true,
      "render": function ( data, type, row ) {
          var str = data.toString()
          var pad = "000000000000000000"
          var ans = pad.substring(0, pad.length - str.length) + str
          var nop = ans.substring(0,2)+"."+ans.substring(2,4)+"."+ans.substring(4,7)+"."+ans.substring(7,10)+"."+ans.substring(10,13)+"-"+ans.substring(13,17)+"."+ans.substring(17,18) ;
        return nop;
        }
      },
    {"data":"jns_transaksi",
      "name":"jns_transaksi",
      "title":"Jenis Transaksi",
      "orderable":true,
      "visible":false,
      "searchable":true
      },
    {"data":"tanggal",
      "name":"tanggal",
      "title":"Tanggal",
      "orderable":true,
      "searchable":true,
      "render": function ( data, type, row ) {
          var str = data.toString()
          var date = str.substring(8,10)+"-"+str.substring(5,7)+"-"+str.substring(0,4) ;
          return date;
        }
      },
    {"data":"sumber",
      "name":"sumber",
      "title":"Sumber Data",
      "orderable":true,
      "visible":false,
      "searchable":true
      },
    {"data": "seksi", 
      "name": "seksi.nama",
      "title":"Disposisi",
      "orderable": true,
      "visible":false,
      "searchable": true
      },
    {"data": "action", 
      "name": "action",
      "title":"Opsi",
      "orderable": false,
      @if (Auth::user()->seksi == 8)
      @else "visible":false,
      @endif
      "searchable": false
      }
    ]});

// Add event listener for opening and closing details
    $('#dataTableBuilder tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( template(row.data()) ).show();
            tr.addClass('shown');
        }
    });
</script>
@endsection