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
      @if (empty($beritas))
      <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>Belum ada berita yang diinput, silakan input terlebih dahulu.</p>
      </div>
      @else
      <ul class="timeline">
      @foreach ($beritas as $berita)

      <?php
      $tanggal = $berita->tgl_berita;
            $tanggal = explode('-', $tanggal);
            $hari = $tanggal[2];
            $bulan = $tanggal[1];
            $tahun = $tanggal[0];
            $tgl_berita = $hari." ".$nama_bulan[$bulan]." ".$tahun;

            $jam = $berita->created_at;
            $jam = explode(' ', $jam);
            $jam = explode(':', $jam[1]);
            $jam = $jam[0].":".$jam[1];
      ?>
        <li class="time-label">
          <span class="bg-teal">
            {{ $tgl_berita }}
          </span>
        </li>
        <li>
          <i class="fa fa-envelope bg-blue"></i>
          <div class="timeline-item">
            <span class="time">
              <i class="fa fa-pencil"></i>
              Dikirim oleh {{ $pengirim[$berita->pengirim] }}
              <i class="fa fa-clock-o"></i>
              {{ $jam }}
            </span>
            <h3 class="timeline-header">
              <strong>{{ $berita->sumber }}</strong> | {{ $berita->judul }}
            </h3>
            <div class="timeline-body">
              <img src="{{ asset('img/mediamassa/'.$berita->file) }}">
              {!! $berita->deskripsi !!}
            </div>
            <div class="timeline-footer">
              @if (Auth::user()->nip == $berita->pengirim)
              <a href="{{ route('mediamassa.edit', $berita->id) }}">
                <button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</button>
              </a>
              @else
              <button class="btn btn-primary btn-xs disabled"><i class="fa fa-edit"></i> Edit</button>
              @endif
              <button class="btn btn-danger btn-xs @if (Auth::user()->nip == $berita->pengirim) @else disabled @endif" data-toggle="modal" data-target="#myModal-{{$berita->id}}"><i class="fa fa-trash"></i> Hapus</button>
            </div>
          </div>
        </li>
      @endforeach
      <!-- END timeline item -->
        <li>
          <i class="fa fa-clock-o bg-gray"></i>
        </li>
      </ul>
      <div class="text-center">
      {{ $beritas->links() }}
      </div>

      <!-- Delete Modal -->
        @if (Auth::user()->nip == $berita->pengirim)
        @foreach ($beritas as $berita)
        <div class="modal fade" id="myModal-{{$berita->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Hapus Alket Media Massa</h4>
              </div>
              <div class="modal-body">
                Anda yakin ingin menghapus Alket Media Massa dari {{ $berita->sumber }} tanggal {{ $berita->tgl_berita }} yang berjudul {{ $berita->judul }}?
              </div>
              <div class="modal-footer">
              {!! Form::model($berita, ['url' => route('mediamassa.destroy', $berita->id) ,'method' => 'delete'] ) !!}
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
              {!! Form::close()!!}
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @else
        @endif
      @endif
    </div>
  </div>
@endsection