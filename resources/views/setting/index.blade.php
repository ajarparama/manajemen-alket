@extends('layout.dashboard')

@section('judul', 'Setting')

@section('deskripsi', 'atau pengaturan')

@section('css')
<link rel="stylesheet" href="{{ asset('css/blue.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/'.Auth::user()->userpic) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>

              <p class="text-muted text-center">{{ $seksi[Auth::user()->seksi] }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIP</b> <a class="pull-right">{{ Auth::user()->nip }}</a>
                </li>
              </ul>

                <a href="{{ route('setting.editpegawai', Auth::user()->id) }}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editModal-{{Auth::user()->id}}"><b>Edit Profil</b></a>
                <a href="{{ route('setting.editpegawai', Auth::user()->id) }}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#gantiPassword-{{Auth::user()->id}}"><b>Ganti Password</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>

    <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pegawai" data-toggle="tab">Pegawai</a></li>
              <li><a href="#wilayah" data-toggle="tab">Wilayah KPP</a></li>
              <li><a href="#datakantor" data-toggle="tab">Data Kantor</a></li>
              <li><a href="#tentangaplikasi" data-toggle="tab">Tentang Aplikasi</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="pegawai">

                @if (Auth::user()->seksi == 8)
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPegawai">Tambah Pegawai</button>
                @else
                <button type="button" class="btn btn-primary disabled" >Tambah Pegawai</button>
                @endif

                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 30px;"></th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>Seksi</th>
                      @if (Auth::user()->seksi == 8)
                      <th style="width: 150px;">Opsi</th>
                      @else
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td><img class="user-table img-circle" src="{{ asset('img/'.$user->userpic) }}" alt="userpic-{{ $user->nip }}"></td>
                      <td>{{ $user->nama }}</td>
                      <td>{{ $user->nip }}</td>
                      <td>@if (!empty($seksi[$user->seksi])) {{ $seksi[$user->seksi] }} @else @endif</td>
                      @if (Auth::user()->seksi == 8)
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('setting.editpegawai', $user->id) }}" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editModal-{{$user->id}}"><i class="fa fa-edit"></i> Edit</a>
                          <a href="" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal-{{$user->id}}"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                      </td>
                      @else
                      @endif
                    </tr>
                  @endforeach
                  </tbody>
                </table>

                  <div class="modal fade" id="gantiPassword-{{Auth::user()->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        {!! Form::model($user, [
                          'url'     => route('setting.gantipassword', Auth::user()->id), 
                          'method'  => 'put',
                          'class'   => 'box-body'
                          ]) !!}
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="gantiPasswordLabel">Ganti Password</h4>
                        </div>
                        <div class="modal-body">

                          <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Password') }}
                            <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Masukkan Password" required autofocus>

                            @if ($errors->has('password'))
                              <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                          </div>

                          <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {{ Form::label('password', 'Ketik Ulang Password') }}
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password') }}" placeholder="Ketik Ulang Password" required>

                            @if ($errors->has('password_confirmation'))
                              <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                              </span>
                            @endif
                          </div>

                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                      {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="tambahPegawai">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form role="form" method="POST" action="{{ url('daftar') }}">
                      {{ csrf_field() }}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Pegawai</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group has-feedback{{ $errors->has('nama') ? ' has-error' : '' }}">
                          {{ Form::label('nama', 'Nama') }}
                          <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama" required autofocus>

                          @if ($errors->has('nama'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('nip') ? ' has-error' : '' }}">
                          {{ Form::label('nip', 'NIP Pendek') }}
                          <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP Pendek" required>

                          @if ($errors->has('nip'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('seksi') ? ' has-error' : '' }}">
                          {{ Form::label('seksi', 'Seksi') }}
                          <select id="seksi" class="form-control" name="seksi" value="{{ old('seksi') }}">
                            <option value="7">Seksi Pelayanan</option>
                            <option value="8">Seksi PDI</option>
                            <option value="6">Seksi Waskon 1</option>
                            <option value="2">Seksi Waskon 2</option>
                            <option value="3">Seksi Waskon 3</option>
                            <option value="4">Seksi Waskon 4</option>
                            <option value="1">Seksi Eksten</option>
                            <option value="9">Subbag Umum</option>
                            <option value="10">Seksi Penagihan</option>
                            <option value="12">Seksi Pemeriksaan</option>
                            <option value="11">Fungsional</option>
                          </select>

                          @if ($errors->has('seksi'))
                            <span class="help-block">
                              <strong>{{ $errors->first('seksi') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                          {{ Form::label('password', 'Password') }}
                          <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan Password" required>

                          @if ($errors->has('password'))
                            <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          {{ Form::label('password-confirm', 'Password Lagi') }}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Ketik Ulang Password" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        {{ Form::label('userpic', 'Jenis Kelamin') }}
                        <div class="radio icheck">
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicm.jpg" checked="checked"> Laki-laki                  
                          </label>
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicf.jpg"> Perempuan 
                          </label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                
                @foreach ($users as $user)
                <div class="modal fade" id="editModal-{{$user->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      {!! Form::model($user, [
                        'url'     => route('setting.updatepegawai', $user->id), 
                        'method'  => 'put',
                        'class'   => 'box-body'
                        ]) !!}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editModalLabel">Edit Pegawai</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group has-feedback{{ $errors->has('nama') ? ' has-error' : '' }}">
                          {{ Form::label('nama', 'Nama') }}
                          <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan Nama" required autofocus>

                          @if ($errors->has('nama'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('nip') ? ' has-error' : '' }}">
                          {{ Form::label('nip', 'NIP Pendek') }}
                          <input id="nip" type="text" class="form-control" name="nip" value="{{ old('nip', $user->nip) }}" placeholder="Masukkan NIP Pendek" required>

                          @if ($errors->has('nip'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nip') }}</strong>
                            </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('seksi') ? ' has-error' : '' }}">
                          {{ Form::label('seksi', 'Seksi') }}
                          <select id="seksi" class="form-control" name="seksi" value="{{ old('seksi', $user->seksi) }}">
                            <option value="7" @if ($user->seksi==7) selected="selected" @endif>Seksi Pelayanan</option>
                            <option value="8" @if ($user->seksi==8) selected="selected" @endif>Seksi PDI</option>
                            <option value="6" @if ($user->seksi==6) selected="selected" @endif>Seksi Waskon 1</option>
                            <option value="2" @if ($user->seksi==2) selected="selected" @endif>Seksi Waskon 2</option>
                            <option value="3" @if ($user->seksi==3) selected="selected" @endif>Seksi Waskon 3</option>
                            <option value="4" @if ($user->seksi==4) selected="selected" @endif>Seksi Waskon 4</option>
                            <option value="1" @if ($user->seksi==1) selected="selected" @endif>Seksi Eksten</option>
                            <option value="9" @if ($user->seksi==9) selected="selected" @endif>Subbag Umum</option>
                            <option value="10" @if ($user->seksi==10) selected="selected" @endif>Seksi Penagihan</option>
                            <option value="12" @if ($user->seksi==12) selected="selected" @endif>Seksi Pemeriksaan</option>
                            <option value="11" @if ($user->seksi==11) selected="selected" @endif>Fungsional</option>
                          </select>

                          @if ($errors->has('seksi'))
                            <span class="help-block">
                              <strong>{{ $errors->first('seksi') }}</strong>
                            </span>
                          @endif
                        </div>

                        {{ Form::label('userpic', 'Jenis Kelamin') }}
                        <div class="radio icheck">
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicm.jpg" checked="checked"> Laki-laki                  
                          </label>
                          <label>
                            <input name="userpic" id="userpic" type="radio" value="userpicf.jpg"> Perempuan 
                          </label>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
                    {!! Form::close() !!}
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteModalLabel">Hapus Pegawai</h4>
                      </div>
                      <div class="modal-body">
                        Anda yakin ingin menghapus {{ $user->nama }} dari aplikasi ini?
                      </div>
                      <div class="modal-footer">
                      {!! Form::model($user, ['url' => route('setting.hapuspegawai', $user->id) ,'method' => 'delete'] ) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                      {!! Form::close()!!}
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>


              <div class="tab-pane" id="wilayah">
                @if (Auth::user()->seksi == 8)
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahWilayah">Tambah Wilayah</button>
                @else
                <button type="button" class="btn btn-primary disabled" >Tambah Wilayah</button>
                @endif

                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Wilayah</th>
                      @if (Auth::user()->seksi == 8)
                      <th>Opsi</th>
                      @else
                      @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wilayahs as $index => $wilayah)
                    <tr>
                      <td>{{ $index+1 }}</td>
                      <td>{{ $wilayah->nama }}</td>
                      @if (Auth::user()->seksi == 8)
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('setting.editwilayah', $wilayah->id) }}" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editWilayah-{{$wilayah->id}}"><i class="fa fa-edit"></i> Edit</a>
                          <a href="" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteWilayah-{{$wilayah->id}}"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                      </td>
                      @else
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="modal fade" id="tambahWilayah">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form role="form" method="POST" action="{{ url('tambahwilayah') }}">
                      {{ csrf_field() }}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Wilayah</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group has-feedback{{ $errors->has('nama_wilayah') ? ' has-error' : '' }}">
                          {{ Form::label('nama_wilayah', 'Nama Wilayah') }}
                          <input id="nama_wilayah" type="text" class="form-control" name="nama_wilayah" value="{{ old('nama_wilayah') }}" placeholder="Masukkan Nama Wilayah" required autofocus>

                          @if ($errors->has('nama_wilayah'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama_wilayah') }}</strong>
                            </span>
                          @endif
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>

                @foreach ($wilayahs as $wilayah)
                <div class="modal fade" id="editWilayah-{{$wilayah->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      {!! Form::model($wilayah, [
                        'url'     => route('setting.updatewilayah', $wilayah->id), 
                        'method'  => 'put',
                        'class'   => 'box-body'
                        ]) !!}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Wilayah</h4>
                      </div>
                      <div class="modal-body">

                        <div class="form-group has-feedback{{ $errors->has('nama_wilayah') ? ' has-error' : '' }}">
                          {{ Form::label('nama_wilayah', 'Nama Wilayah') }}
                          <input id="nama_wilayah" type="text" class="form-control" name="nama_wilayah" value="{{ $wilayah->nama }}" placeholder="Masukkan Nama Wilayah" required autofocus>

                          @if ($errors->has('nama_wilayah'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nama_wilayah') }}</strong>
                            </span>
                          @endif
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                      </div>
                    {!! Form::close()!!}
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="deleteWilayah-{{$wilayah->id}}" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteModalLabel">Hapus Pegawai</h4>
                      </div>
                      <div class="modal-body">
                        Anda yakin ingin menghapus {{ $wilayah->nama }} dari aplikasi ini?
                      </div>
                      <div class="modal-footer">
                      {!! Form::model($wilayah, ['url' => route('setting.hapuswilayah', $wilayah->id) ,'method' => 'delete'] ) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        {!! Form::submit('Hapus', ['class'=>'btn btn-danger']) !!}
                      {!! Form::close()!!}
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>

              <div class="tab-pane" id="datakantor">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('setting.updatesetting') }}">
                      {{ csrf_field() }}
                  <div class="form-group">
                    <label for="nama_kantor" class="col-sm-2 control-label">Nama Kantor</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_kantor" name="nama_kantor" @if (!empty($array_settings[0])) value="{{ $array_settings[0] }}" @else @endif placeholder="Misal: Kantor Pelayanan Pajak Pratama Pangkalan Bun" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lokasi_kantor" class="col-sm-2 control-label">Lokasi Kantor</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="lokasi_kantor" name="lokasi_kantor" @if (!empty($array_settings[1])) value="{{ $array_settings[1] }}" @else @endif placeholder="Misal: Pangkalan Bun" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_kakap" class="col-sm-2 control-label">Nama Kepala Kantor</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_kakap" name="nama_kakap" @if (!empty($array_settings[2])) value="{{ $array_settings[2] }}" @else @endif placeholder="Masukkan Nama Kepala Kantor" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nip_kakap" class="col-sm-2 control-label">NIP Kepala Kantor</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nip_kakap" name="nip_kakap" @if (!empty($array_settings[3])) value="{{ $array_settings[3] }}" @else @endif placeholder="Masukkan NIP Panjang" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_kanwil" class="col-sm-2 control-label">Nama Kanwil</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nama_kanwil" name="nama_kanwil" @if (!empty($array_settings[4])) value="{{ $array_settings[4] }}" @else @endif placeholder="Misal: Kantor Wilayah DJP Kalimantan Selatan dan Tengah" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lokasi_kanwil" class="col-sm-2 control-label">Lokasi Kanwil</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="lokasi_kanwil" name="lokasi_kanwil" @if (!empty($array_settings[5])) value="{{ $array_settings[5] }}" @else @endif placeholder="Misal: Banjarmasin" @if (Auth::user()->seksi != 8) disabled @endif>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      @if (Auth::user()->seksi == 8)
                      <button type="submit" class="btn btn-danger">Simpan</button>
                      @else
                      <a href="#" class="btn btn-danger disabled">Simpan</a>
                      @endif
                    </div>
                  </div>
                </form>
              </div>

              <div class="tab-pane" id="tentangaplikasi">
              <h1>Manajemen<b>Alket</b></h1><br>
              <p>Anda benar, aplikasi ini digunakan untuk manajemen alket.<br>
              Dibuat dan dikembangkan oleh Ajar Parama Adhi.<br><br>
              Jika ada saran atau masukan bisa menghubungi <a href="mailto:ajarparama.adhi@pajak.go.id">ajarparama.adhi@pajak.go.id</a></p>
              <p>Versi 0.9.0</p>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
    </div>
  </div>
@endsection

@section ('scripts')
</script>
<script src="{{ asset('js/icheck.min.js') }}"></script>
@if (Session::has('errors'))
  <script>
    $(document).ready(function(){
      $('#tambahPegawai').modal({show: true});
    });
  </script>
@endif
<script>
  $(function () {
    $('.icheck').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
@endsection