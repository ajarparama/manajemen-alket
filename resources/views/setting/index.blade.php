@extends('layout.dashboard')

@section('judul', 'Setting')

@section('deskripsi', 'atau pengaturan')

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

              <a href="#" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>

    <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pegawai" data-toggle="tab">Pegawai</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="pegawai">
                <a href=""><button type="button" class="btn btn-primary">Tambah Pegawai</button></a>
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
                      <td>{{ $seksi[Auth::user()->seksi] }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                          <a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>

              </div>

              <div class="tab-pane" id="settings">
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
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
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