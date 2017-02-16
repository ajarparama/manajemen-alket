@extends('layout.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('css/blue.css') }}">
<link rel="stylesheet" href="{{ asset('css/selectize.bootstrap3.css') }}">
@endsection

@section('judul', 'Alket')

@section('deskripsi', 'edit alket')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <i class="fa fa-edit"></i>
          <h3 class="box-title">Edit Alket</h3>
        </div>
        <div class="box-body">
        {!! Form::model($alket, [
            'url'     => route('alket.update', $alket->id), 
            'method'  => 'put',
            'class'   => 'box-body'
            ]) !!}

            <div class="row">
              <div class="col-md-6">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('nama_penjual') ? 'has-error' : '' }}">
                      {{ Form::label('nama_penjual', 'Nama Penjual') }}
                      {{ Form::text('nama_penjual', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nama Penjual')) }}
                      @if ($errors->has('nama_penjual'))
                        <span class="help-block">
                          {{ $errors->first('nama_penjual') }}
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('npwp_penjual') ? 'has-error' : '' }}">
                      {{ Form::label('npwp_penjual', 'NPWP Penjual') }}
                      <input data-inputmask="'mask': '99.999.999.9-999.999', 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan NPWP Penjual" name="npwp_penjual" id="npwp_penjual" value="{{ old( 'npwp_penjual', $alket->npwp_penjual ) }}">
                      @if ($errors->has('npwp_penjual'))
                        <span class="help-block">
                          {{ $errors->first('npwp_penjual') }}
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('nama_pembeli') ? 'has-error' : '' }}">
                      {{ Form::label('nama_pembeli', 'Nama Pembeli') }}
                      {{ Form::text('nama_pembeli', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nama Pembeli')) }}
                      @if ($errors->has('nama_pembeli'))
                        <span class="help-block">
                          {{ $errors->first('nama_pembeli') }}
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group {{ $errors->has('npwp_pembeli') ? 'has-error' : '' }}">
                      {{ Form::label('npwp_pembeli', 'NPWP Pembeli') }}
                      <input data-inputmask="'mask': '99.999.999.9-999.999', 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan NPWP Pembeli" name="npwp_pembeli" id="npwp_pembeli" value="{{ old( 'npwp_pembeli', $alket->npwp_pembeli ) }}">
                      @if ($errors->has('npwp_pembeli'))
                        <span class="help-block">
                          {{ $errors->first('npwp_pembeli') }}
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="form-group {{ $errors->has('nilai_data') ? 'has-error' : '' }}">
                  {{ Form::label('nilai_data', 'Nilai Data') }}
                  <input data-inputmask="'alias': 'numeric', 'groupSeparator': '.', 'radixPoint': ',', 'autoGroup': true, 'numericInput': true, 'digits': 0, 'prefix': 'Rp ', 'rightAlign': false, 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan Nilai Data" name="nilai_data" id="nilai_data" value="{{ old( 'nilai_data', $alket->nilai_data ) }}">
                  @if ($errors->has('nilai_data'))
                    <span class="help-block">
                      {{ $errors->first('nilai_data') }}
                    </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('nop') ? 'has-error' : '' }}">
                  {{ Form::label('nop', 'NOP') }}
                  <input data-inputmask="'mask': '99.99.999.999.999-9999.9', 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan NOP" name="nop" id="nop" value="{{ old( 'nop', $alket->nop ) }}">
                  @if ($errors->has('nop'))
                    <span class="help-block">
                      {{ $errors->first('nop') }}
                    </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('jns_transaksi') ? 'has-error' : '' }}">
                  {{ Form::label('jns_transaksi', 'Jenis Transaksi') }}
                  <select name="jns_transaksi" id="jns_transaksi" placeholder="Masukkan Jenis Transaksi">
                      <option value="{{ old( 'jns_transaksi', $alket->jns_transaksi ) }}">{{ old( 'jns_transaksi', $alket->jns_transaksi ) }}</option>
                      <option value="Jual Beli Tanah">Jual Beli Tanah</option>
                      <option value="Jual Beli Tanah & Bangunan">Jual Beli Tanah & Bangunan</option>
                      <option value="Jual Beli Barang/Jasa">Jual Beli Barang/Jasa</option>
                  </select>
                  @if ($errors->has('jns_transaksi'))
                    <span class="help-block">
                      {{ $errors->first('jns_transaksi') }}
                    </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('tanggal') ? 'has-error' : '' }}">
                <?php if (!empty($alket->tanggal)) {
                  $tanggal_awal = old( 'tanggal', $alket->tanggal );
                  $pisah = explode(" ", $tanggal_awal);
                  $pisah = explode("-", $pisah[0]); ?>
                  {{ Form::label('tanggal', 'Tanggal Alket') }}
                  <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal Alket" class="form-control" name="tanggal" id="tanggal" value="{{ $pisah[2].$pisah[1].$pisah[0] }}">
                  @if ($errors->has('tanggal'))
                    <span class="help-block">
                      {{ $errors->first('tanggal') }}
                    </span>
                  @endif
                </div>
                
                <?php
                } else { ?>
                  {{ Form::label('tanggal', 'Tanggal Alket') }}
                  <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal Alket" class="form-control" name="tanggal" id="tanggal">
                  @if ($errors->has('tanggal'))
                    <span class="help-block">
                      {{ $errors->first('tanggal') }}
                    </span>
                  @endif
                </div>
                <?php }
                ?>

                <div class="form-group {{ $errors->has('sumber') ? 'has-error' : '' }}">
                  {{ Form::label('sumber', 'Sumber Data') }}
                  <select name="sumber" id="sumber" placeholder="Masukkan Sumber Data">
                      <option value="{{ old( 'sumber', $alket->sumber ) }}">{{ old( 'sumber', $alket->sumber ) }}</option>
                    @foreach ($ppats as $ppat)
                      <option value="{{ $ppat }}">{{ $ppat }}</option>
                    @endforeach
                  </select>
                  @if ($errors->has('sumber'))
                    <span class="help-block">
                      {{ $errors->first('sumber') }}
                    </span>
                  @endif
                </div>

                <div class="form-group {{ $errors->has('disposisi') ? 'has-error' : '' }}">
                  {{ Form::label('disposisi', 'Disposisi Ke') }}
                  <div class="row">
                    <div class="col-md-6">
                      <ul style="list-style: none; padding-left: 0;">
                        <li>
                          <label style="font-weight: normal;">
                          <input name="disposisi[]" type="checkbox" value="1" @if (in_array(1, $alket_disposisi)) checked @else @endif> Seksi Eksten
                          </label>
                        </li>
                        <li>
                          <label style="font-weight: normal;">
                          <input name="disposisi[]" type="checkbox" value="2" @if (in_array(2, $alket_disposisi)) checked @else @endif> Seksi Waskon 2
                          </label>
                        </li>
                        <li>
                          <label style="font-weight: normal;">
                          <input name="disposisi[]" type="checkbox" value="3" @if (in_array(3, $alket_disposisi)) checked @else @endif> Seksi Waskon 3
                          </label>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <ul style="list-style: none; padding-left: 0;">
                        <li>
                          <label style="font-weight: normal;">
                          <input name="disposisi[]" type="checkbox" value="4" @if (in_array(4, $alket_disposisi)) checked @else @endif> Seksi Waskon 4
                          </label>
                        </li>
                        <li>
                          <label style="font-weight: normal;">
                          <input name="disposisi[]" type="checkbox" value="5" @if (in_array(5, $alket_disposisi)) checked @else @endif> KPP Lain
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                <a class="btn btn-primary" href="{{ url('alket') }}">Batal</a>

              </div>
            </div>

        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
</script>
<script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('js/icheck.min.js') }}"></script>
<script src="{{ asset('js/selectize.min.js') }}"></script>
<script>
  $(function () {
    $(":input").inputmask();
    $(":input").iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    $("#sumber").selectize({
    create: true,
    sortField: {
        field: 'text',
        direction: 'asc'
    },
    dropdownParent: 'body'
    });
    $("#jns_transaksi").selectize({
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