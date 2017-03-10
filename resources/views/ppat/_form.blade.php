              <div class="row">
                <div class="col-md-6">

                  <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                    {{ Form::label('nama', 'Nama PPAT') }}
                    {{ Form::text('nama', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nama PPAT')) }}
                    @if ($errors->has('nama'))
                      <span class="help-block">
                        {{ $errors->first('nama') }}
                      </span>
                    @endif
                  </div>
                  <div class="row">
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('npwp') ? 'has-error' : '' }}">
                        {{ Form::label('npwp', 'NPWP') }}
                        {{ Form::text('npwp', null, array('class' => 'form-control', 'placeholder'=> 'Masukan NPWP')) }}
                        @if ($errors->has('npwp'))
                          <span class="help-block">
                            {{ $errors->first('npwp') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::text('email', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Email')) }}
                        @if ($errors->has('email'))
                          <span class="help-block">
                            {{ $errors->first('email') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                        {{ Form::label('no_hp', 'Nomor HP') }}
                        {{ Form::text('no_hp', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nomor HP')) }}
                        @if ($errors->has('no_hp'))
                          <span class="help-block">
                            {{ $errors->first('no_hp') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                        {{ Form::label('no_telp', 'Nomor Telepon') }}
                        {{ Form::text('no_telp', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nomor Telepon')) }}
                        @if ($errors->has('no_telp'))
                          <span class="help-block">
                            {{ $errors->first('no_telp') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                    {{ Form::label('alamat', 'Alamat') }}
                    {{ Form::text('alamat', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Alamat')) }}
                    @if ($errors->has('alamat'))
                      <span class="help-block">
                        {{ $errors->first('alamat') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('kabupaten') ? 'has-error' : '' }}">
                    {{ Form::label('kabupaten', 'Kabupaten/Kota') }}
                    {{ Form::text('kabupaten', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Kabupaten/Kota')) }}
                    @if ($errors->has('kabupaten'))
                      <span class="help-block">
                        {{ $errors->first('kabupaten') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('ar_nip') ? 'has-error' : '' }}">
                    {{ Form::label('ar_nip', 'Account Representative') }}
                    {{ Form::text('ar_nip', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Account Representative')) }}
                    @if ($errors->has('ar_nip'))
                      <span class="help-block">
                        {{ $errors->first('ar_nip') }}
                      </span>
                    @endif
                  </div>

                  {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                  <a class="btn btn-primary" href="{{ url('lapppat') }}">Batal</a>

                </div>
              </div>