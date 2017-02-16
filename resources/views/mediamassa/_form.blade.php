              <div class="row">
                <div class="col-md-6">

                  <div class="form-group {{ $errors->has('judul') ? 'has-error' : '' }}">
                    {{ Form::label('judul', 'Judul') }}
                    {{ Form::text('judul', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Judul')) }}
                    @if ($errors->has('judul'))
                      <span class="help-block">
                        {{ $errors->first('judul') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('nota_dinas') ? 'has-error' : '' }}">
                    {{ Form::label('nota_dinas', 'Nomor Nota Dinas') }}
                    {{ Form::text('nota_dinas', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Nomor Nota Dinas')) }}
                    @if ($errors->has('nota_dinas'))
                      <span class="help-block">
                        {{ $errors->first('nota_dinas') }}
                      </span>
                    @endif
                  </div>

                  <div class="row">
                    <div class="col-md-6">                  
                      <div class="form-group {{ $errors->has('sumber') ? 'has-error' : '' }}">
                        {{ Form::label('sumber', 'Sumber Berita') }}
                        {{ Form::text('sumber', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Sumber Berita')) }}
                        @if ($errors->has('sumber'))
                          <span class="help-block">
                            {{ $errors->first('sumber') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('tgl_berita') ? 'has-error' : '' }}">
                        {{ Form::label('tgl_berita', 'Tanggal Berita') }}
                        <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal Berita" class="form-control" name="tgl_berita" id="tgl_berita" value="{{ $tgl_berita_old }}">
                        @if ($errors->has('tgl_berita'))
                          <span class="help-block">
                            {{ $errors->first('tgl_berita') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('tes') ? 'has-error' : '' }}">
                    {{ Form::label('file', 'Gambar') }}
                    <input id="file" name="file" type="file">
                    @if ($errors->has('file'))
                      <span class="help-block">
                        {{ $errors->first('file') }}
                      </span>
                    @endif
                  </div>
                  <div id="image-holder">@if (!empty($file_old)) <img src="{{ asset('img/mediamassa/'.$file_old) }}" class="thumb-image"> @else @endif</div>

                  <div class="form-group {{ $errors->has('deskripsi') ? 'has-error' : '' }}">
                    {{ Form::label('deskripsi', 'Deskripsi') }}
                    <textarea class="deskripsi" id="deskripsi" name="deskripsi">{{ $deskripsi_old }}</textarea>
                    @if ($errors->has('deskripsi'))
                      <span class="help-block">
                        {{ $errors->first('deskripsi') }}
                      </span>
                    @endif
                  </div>

                  {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                  <a class="btn btn-primary" href="{{ url('mediamassa') }}">Batal</a>

                </div>
              </div>