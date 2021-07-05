<div class="modal fade" id="update{{$datass->id_alumni}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Alumni</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/alumni/update" method="POST">
                                    {{csrf_field()}}
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Nama Alumni</label>
                        <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" value="nama_alumni" placeholder="">
                      </div>

                        <div class="form-group">
                          <label for="id_gender" class="font-weight-bold text-dark">Jenis Kelamin</label>
                          <select name="id_gender" id="gender" class="custom-select" required>
                              <option>- Pilih Gender -</option>
                              @foreach($gender as $genders)
                              <option value="{{$gender->id_gender}}" @if($datass->id_gender==$gender->id_gender) selected @endif>{{$gender->nama_gender}}</option>
                              @endforeach
                          </select>
                        </div>

                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Alamat</label>
                        <input type="text" class="form-control" id="alamat_alumni" name= "alamat_alumni" value="alamat_alumni" placeholder="">
                      </div>
                      <div class="form-group">
                          <label for="id_prodi" class="font-weight-bold text-dark">Program Studi</label>
                          <select name="id_prodi" id="prodi" class="custom-select" required>
                              <option>- Pilih prodi -</option>
                              @foreach($prodi as $prodis)
                              <option value="{{$prodi->id_prodi}}" @if($datass->id_prodi==$prodi->id_prodi) selected @endif>{{$prodi->nama_prodi}}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="id_angkatan" class="font-weight-bold text-dark">Jenis Kelamin</label>
                          <select name="id_angkatan" id="angktan" class="custom-select" required>
                              <option>- Pilih angktan -</option>
                              @foreach($angktan as $angktans)
                              <option value="{{$angktan->id_angkatan}}" @if($datass->id_angkatan==$angktan->id_angkatan) selected @endif>{{$angktan->tahun_angktan}}</option>
                              @endforeach
                          </select>
                        </div>

                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Email</label>
                        <input type="email" class="form-control" id="email_alumni" name= "email_alumni" value="email_alumni" placeholder="">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Handphone</label>
                        <input type="text" class="form-control" id="no_hp" name= "no_hp"  value="no_hp" placeholder="">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">ID Line</label>
                        <input type="text" class="form-control" id="id_line" name= "id_line" value="id_line"  placeholder="">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">ID Telegram</label>
                        <input type="text" class="form-control" id="id_telegram" name= "id_telegram" value="id_telegram" placeholder="">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Tahun Lulus</label>
                        <input type="date" class="form-control" id="tahun_lulus" name= "tahun_lulus"  value="tahun_lulus" placeholder="">
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Tahun Wisuda</label>
                        <input type="date" class="form-control" id="tahun_wisuda" name= "tahun_wisuda" value="tahun_wisuda" placeholder="">
                      </div>
	      	            <div class="modal-footer">
		                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		                      <button type="submit" class="btn btn-success">Simpan</button>
		                  </div>
                      </form>
                                </div>
                            </div>
                        </div>
                    </div>






















                    <div class="modal fade" id="update{{$datass->id_alumni}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Alumni</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/alumni/update" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id_alumni" value="{{$datass->id_alumni}}">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Nama Alumni</label>
                                            <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" value="{{$datass->nama_alumni}}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Satuan</label>
                                            <input type="text" class="form-control" id="satuan" name="satuan" value="{{$datass->satuan}}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Harga</label>
                                            <input type="text" class="form-control" id="harga" name= "harga" value="{{$datass->harga}}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="id_prodi" class="font-weight-bold text-dark">Program Studi</label>
                                            <select name="id_prodi" id="prodis" class="custom-select" required>
                                                <option>- Pilih Prodi -</option>
                                                @foreach($prodi as $prodis)
                                                <option value="{{$prodis->id_prodi}}" @if($datass->id_prodi==$prodis->id_prodi) selected @endif>{{$prodis->nama_prodi}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan" class="font-weight-bold text-dark">Keterangan</label>
                                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$datass->keterangan}}" placeholder="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>







                    <div class="container">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" align="center" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:centre;">No.</th>
                      <th style="text-align:center;">Tanggal Posting</th>
                      <th style="text-align:center;">Pengumuman</th>
                      <!-- <th style="text-align:center;">Thumbnail</th>
                      <th style="text-align:center;">File</th> -->
                    </tr>
                  </thead>

                  <tbody>
                        @foreach ($pengumuman as $announce)
                            <tr class="success">
                                <td style="width: 5%;">{{ $loop->iteration }}</td>
                                <td style="width: 10%" >{{ $announce->tgl_post }}</td>
                                <td >{{ $announce->pengumuman }}</td>
                                <!-- <td>
                                <img src="{{asset('storage/app/public/image/post'.$announce->thumbnail) }}" alt="Image 10"  width="300" height="300" />
                                </td> -->
                                <!-- <td style="width: 30px;">{{ $announce->thumbnail }}</td>
                                <td style="width: 30px;">{{ $announce->lampiran }}</td>
                                 -->
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</div>