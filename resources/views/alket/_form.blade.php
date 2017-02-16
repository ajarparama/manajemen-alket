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
                <?php
                  $tanggal_awal = old( 'tanggal', $alket->tanggal );
                  $pisah = explode("-", $tanggal_awal);
                ?>
                  {{ Form::label('tanggal', 'Tanggal') }}
                  <input data-inputmask="'alias': 'dd/mm/yyyy'" placeholder="Masukan Tanggal" class="form-control" name="tanggal" id="tanggal" value="{{ $pisah[2].$pisah[1].$pisah[0] }}">
                  @if ($errors->has('tanggal'))
                    <span class="help-block">
                      {{ $errors->first('tanggal') }}
                    </span>
                  @endif
                </div>

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
                        @foreach ($list_disposisi as $disposisi)
                        @if (in_array($disposisi->id, $alket_disposisi))
                        <li>
                          <label style="font-weight: normal;">
                          {{ Form::checkbox('disposisi[]', $disposisi->id, true) }} {{ $disposisi->nama }}
                        </li>
                        @else
                        <li>
                          <label style="font-weight: normal;">
                          {{ Form::checkbox('disposisi[]', $disposisi->id, false) }} {{ $disposisi->nama }}
                        </li>
                        @endif
                        @endforeach
                      </ul>
                    </div>
                    <div class="col-md-6">
                      <ul style="list-style: none; padding-left: 0;">
                        @foreach ($list_disposisi2 as $disposisi)
                        @if (in_array($disposisi->id, $alket_disposisi))
                        <li>
                          <label style="font-weight: normal;">
                          {{ Form::checkbox('disposisi[]', $disposisi->id, true) }} {{ $disposisi->nama }}
                        </li>
                        @else
                        <li>
                          <label style="font-weight: normal;">
                          {{ Form::checkbox('disposisi[]', $disposisi->id, false) }} {{ $disposisi->nama }}
                        </li>
                        @endif
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>

                {!! Form::submit('Simpan', ['class'=>'btn btn-success']) !!} 
                <a class="btn btn-primary" href="{{ url('alket') }}">Batal</a>

              </div>
            </div>