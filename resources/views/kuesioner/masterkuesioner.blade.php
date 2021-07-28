@extends('layoutadmin.layout')
@section('title', 'Master Pertanyaan')
@section('collapse3')
    collapse-item active
@endsection

@section('active6')
      nav-item active
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Pertanyaan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#create"><i
                            class="fas fa-plus"></i> Tambah Data Pertanyaan
                    </button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="width: fit-content;">No.</th>
                      <th style="text-align:center;">Data Pertanyaan</th>
                      <th style="text-align:center;">Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                        @foreach ($pertanyaan as $quiz)
                            <tr class="success">
                                <td style="width: fit-content;">{{ $loop->iteration }}</td>
                                <td>{{ $quiz->type_kuesioner }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#show{{$quiz->id_kuesioner}}"><i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Edit -->
                                    <button class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#update{{$quiz->id_kuesioner}}"><i class="fas fa-edit"></i>
                                    </button>
                                    <!--Delete -->
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{$quiz->id_kuesioner}}"><i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          @foreach($pertanyaan as $quiz)
        <!-- Modal Show -->
        <div class="modal fade"  id="show{{$quiz->id_kuesioner}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                        <div class="modal-dialog"  role="document" >
                            <div class="modal-content" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Data Pertanyaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table width="100%" cellspacing="30">
                                        <td>
                                        <input type="hidden" name="id_lab" value="{{$quiz->id_kuesioner}}">
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark">Data Pertanyaan</label>
                                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi"
                                                value="{{$quiz->type_kuesioner}}" readonly>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="delete{{$quiz->id_kuesioner}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin menghapus data pertanyaan?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tidak</button>
                                    <a href="/admin/masterpertanyaan/{{$quiz->id_kuesioner}}/delete"><button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Ya</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Delete -->

                    <!-- //Update -->
                    <div class="modal fade" id="update{{$quiz->id_kuesioner}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pertanyaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  <form action="/admin/masterpertanyaan/update" method="POST" enctype="multipart/form-data">
                                  <input type="hidden" name="id_kuesioner" value="{{$quiz->id_kuesioner}}">
                                    {{ csrf_field() }}
                                        
                                <div class="form-group">
                                    <label class="font-weight-bold text-dark">Data Pertanyaan</label>
                                    <input type="text" class="form-control" id="type_kuesioner" name="type_kuesioner" value="{{$quiz->type_kuesioner}}" placeholder="">
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
        @endforeach

        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	          <div class="modal-dialog" role="document">
	             <div class="modal-content">
	                <div class="modal-header">
	                  <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Pertanyaan</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                      <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	      	          <form action="/admin/masterpertanyaan/create" method="POST">
                      {{csrf_field()}}
                      <div class="form-group">
                        <label class="font-weight-bold text-dark">Data Pertanyaan</label>
                        <input type="text" class="form-control" id="type_kuesioner" name="type_kuesioner" placeholder="">
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

@endsection
