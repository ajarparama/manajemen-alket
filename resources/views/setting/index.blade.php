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
                <a href="{{ route('setting.editpegawai', Auth::user()->id) }}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#editModal-{{Auth::user()->id}}"><b>Ganti Password</b></a>
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
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="pegawai">
                <a href="#"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPegawai">Tambah Pegawai</button></a>
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 30px;"></th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>Seksi</th>
                      <th style="width: 150px;">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td><img class="user-table img-circle" src="{{ asset('img/'.$user->userpic) }}" alt="userpic-{{ $user->nip }}"></td>
                      <td>{{ $user->nama }}</td>
                      <td>{{ $user->nip }}</td>
                      <td>@if (!empty($seksi[$user->seksi])) {{ $seksi[$user->seksi] }} @else @endif</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('setting.editpegawai', $user->id) }}" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editModal-{{$user->id}}"><i class="fa fa-edit"></i> Edit</a>
                          <a href="" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal-{{$user->id}}"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>

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
                @endforeach

                @foreach ($users as $user)
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
                <a href="#"><button class="btn btn-primary" data-toggle="modal" data-target="#tambahWilayah">Tambah Wilayah</button></a>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Wilayah</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wilayahs as $index => $wilayah)
                    <tr>
                      <td>{{ $index+1 }}</td>
                      <td>{{ $wilayah->nama }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('setting.editwilayah', $wilayah->id) }}" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#editWilayah-{{$wilayah->id}}"><i class="fa fa-edit"></i> Edit</a>
                          <a href="" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal-{{$wilayah->id}}"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                      </td>
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
                @endforeach

              </div>

              <div class="tab-pane" id="datakantor">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Kantor</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Nama Kantor">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Lokasi Kantor</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Kabupaten/kota">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Nama Kanwil</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Nama Kanwil">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Lokasi Kanwil</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Kabupaten/kota">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
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