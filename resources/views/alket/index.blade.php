@extends('layout.dashboard')

@section('judul', 'Daftar Alket')

@section('deskripsi', 'menampilkan alket yang sudah diinput')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <a href="{{ route('alket.create') }}"><button type="button" class="btn btn-primary" >Tambah Data</button></a>
        </div>
        <div class="box-body">
            <table class="table table-bordered dataTable" id="dataTableBuilder"></table> 

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

(function(window,$){window.LaravelDataTables=window.LaravelDataTables||{};window.LaravelDataTables["dataTableBuilder"]=$("#dataTableBuilder").DataTable({
  "serverSide":true,
  "processing":true,
  "ajax":"",
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
  "columns":[{
    "data":"nama",
    "name":"nama",
    "title":"Nama",
    "orderable":true,
    "searchable":true},
    {"data": "npwp",
      "name":"npwp",
      "title":"NPWP",
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
    {"data":"jns_transaksi",
      "name":"jns_transaksi",
      "title":"Jenis Transaksi",
      "orderable":true,
      "searchable":true
      },
    {"data":"tanggal",
      "name":"tanggal",
      "title":"Tanggal",
      "orderable":true,
      "searchable":true,
      "render": function ( data, type, row ) {
        var dateSplit = data.split('-');
        return type === "display" || type === "filter" ?
            dateSplit[1] +'-'+ dateSplit[2] +'-'+ dateSplit[0] :
            data;
        }
      },
    {"data":"sumber",
      "name":"sumber",
      "title":"Sumber Data",
      "orderable":true,
      "searchable":true
      },
    {"data": "seksi", 
      "name": "seksi.nama",
      "title":"Disposisi",
      "orderable": true,
      "searchable": true
      },
    {"data": "action", 
      "name": "action",
      "title":"Opsi",
      "orderable": false,
      "searchable": false
      }
    ]});
  })
(window,jQuery);

</script>
@endsection