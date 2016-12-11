              <div class="row">
                <div class="col-md-6">

                  <div class="row">
                    <div class="col-md-6">                  
                      <div class="form-group {{ $errors->has('no_surat') ? 'has-error' : '' }}">
                        {{ Form::label('no_surat', 'No Surat') }}
                        {{ Form::text('no_surat', null, array('class' => 'form-control', 'placeholder'=> 'Masukan No Surat')) }}
                        @if ($errors->has('no_surat'))
                          <span class="help-block">
                            {{ $errors->first('no_surat') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group {{ $errors->has('no_agenda') ? 'has-error' : '' }}">
                        {{ Form::label('no_agenda', 'No Agenda') }}
                        {{ Form::text('no_agenda', null, array('class' => 'form-control', 'placeholder'=> 'Masukan No Agenda')) }}
                        @if ($errors->has('no_agenda'))
                          <span class="help-block">
                            {{ $errors->first('no_agenda') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('bulan') ? 'has-error' : '' }}">
                        {{ Form::label('bulan', 'Bulan') }}
                        {{ Form::select('bulan', $nama_bulan, null, array('class' => 'form-control')) }}
                        @if ($errors->has('bulan'))
                          <span class="help-block">
                            {{ $errors->first('bulan') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('tahun') ? 'has-error' : '' }}">
                        {{ Form::label('tahun', 'Tahun') }}
                        {{ Form::selectRange('tahun', 2014, 2020, date('Y'), array('class' => 'form-control')) }}
                        @if ($errors->has('tahun'))
                          <span class="help-block">
                            {{ $errors->first('tahun') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('ppat_npwp') ? 'has-error' : '' }}">
                    {{ Form::label('ppat_npwp', 'PPAT') }}
                    {{ Form::select('ppat_npwp', $ppats, null, array('class' => 'form-control')) }}
                    @if ($errors->has('ppat_npwp'))
                      <span class="help-block">
                        {{ $errors->first('ppat_npwp') }}
                      </span>
                    @endif
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('tgl_surat') ? 'has-error' : '' }}">
                        {{ Form::label('tgl_surat', 'Tanggal Surat') }}
                        <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal Surat" class="form-control" name="tgl_surat" id="tgl_surat" value="{{ $tgl_surat_old }}">
                        @if ($errors->has('tgl_surat'))
                          <span class="help-block">
                            {{ $errors->first('tgl_surat') }}
                          </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group {{ $errors->has('tgl_terima') ? 'has-error' : '' }}">
                        {{ Form::label('tgl_terima', 'Tanggal Terima') }}
                        <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal Terima" class="form-control" name="tgl_terima" id="tgl_terima" value="{{ $tgl_terima_old }}">
                        @if ($errors->has('tgl_terima'))
                          <span class="help-block">
                            {{ $errors->first('tgl_terima') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="form-group {{ $errors->has('jml_data') ? 'has-error' : '' }}">
                    {{ Form::label('jml_data', 'Jumlah Data') }}
                    {{ Form::number('jml_data', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Jumlah Data')) }}
                    @if ($errors->has('jml_data'))
                      <span class="help-block">
                        {{ $errors->first('jml_data') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('nilai_data') ? 'has-error' : '' }}">
                    {{ Form::label('nilai_data', 'Nilai Data') }}
                    <input data-inputmask="'alias': 'numeric', 'groupSeparator': '.', 'radixPoint': ',', 'autoGroup': true, 'numericInput': true, 'digits': 0, 'prefix': 'Rp ', 'rightAlign': false, 'removeMaskOnSubmit': true" class="form-control" placeholder="Masukan Nilai Data" name="nilai_data" id="nilai_data" value="{{ $nilai_data_old }}">
                    @if ($errors->has('nilai_data'))
                      <span class="help-block">
                        {{ $errors->first('nilai_data') }}
                      </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('jml_alket') ? 'has-error' : '' }}">
                    {{ Form::label('jml_alket', 'Jumlah Transaksi yang Bisa Dimanfaatkan') }}
                    {{ Form::number('jml_alket', null, array('class' => 'form-control', 'placeholder'=> 'Masukan Jumlah Transaksi yang Bisa Dimanfaatkan')) }}
                    @if ($errors->has('jml_alket'))
                      <span class="help-block">
                        {{ $errors->first('jml_alket') }}
                      </span>
                    @endif
                  </div>

                  {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                  <a class="btn btn-primary" href="{{ url('lapppat') }}">Batal</a>

                </div>
              </div>