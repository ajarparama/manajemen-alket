              <div class="row">
                <div class="col-md-6">

                  <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                    {{ Form::label('nama', 'Nama PPAT') }}
                    <input type="text" id="nama" name="nama" class="form-control" @if (empty($ppat)) @else value="{{ old( 'nama', $ppat->nama ) }}" @endif placeholder="Masukan Nama PPAT">
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
                        <input data-inputmask="'mask': '99.999.999.9-999.999', 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan NPWP" name="npwp" id="npwp" value="@if (empty($ppat)) @else {{ old( 'npwp', $ppat->npwp ) }} @endif">
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
                        <input type="text" id="email" name="email" class="form-control" @if (empty($ppat)) @else value="{{ old( 'email', $ppat->email ) }}" @endif placeholder="Masukan Email PPAT">
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
                        <input type="text" id="no_hp" name="no_hp" class="form-control" @if (empty($ppat)) @else value="{{ old( 'no_hp', $ppat->no_hp ) }}" @endif placeholder="Masukan Nomor HP">
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
                        <input type="text" id="no_telp" name="no_telp" class="form-control" @if (empty($ppat)) @else value="{{ old( 'no_telp', $ppat->no_telp ) }}" @endif placeholder="Masukan Nomor Telepon">
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
                    <input type="text" id="alamat" name="alamat" class="form-control" @if (empty($ppat)) @else value="{{ old( 'alamat', $ppat->alamat ) }}" @endif placeholder="Masukan Alamat">
                    @if ($errors->has('alamat'))
                      <span class="help-block">
                        {{ $errors->first('alamat') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('kabupaten') ? 'has-error' : '' }}">
                    {{ Form::label('kabupaten', 'Kabupaten/Kota') }}
                    <select name="kabupaten" id="kabupaten" placeholder="Masukkan Kabupaten/Kota">
                      @if (empty($ppat)) <option value="">Masukkan Kabupaten/Kota</option> @else <option value="{{ old( 'kabupaten', $ppat->kabupaten ) }}">{{ old( 'kabupaten', $ppat->kabupaten ) }}</option> @endif
                    @foreach ($kabupatens as $kabupaten)
                      <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                    @endforeach
                  </select>
                    @if ($errors->has('kabupaten'))
                      <span class="help-block">
                        {{ $errors->first('kabupaten') }}
                      </span>
                    @endif
                  </div>

                  {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                  <a class="btn btn-primary" href="{{ url('ppat') }}">Batal</a>

                </div>
              </div>