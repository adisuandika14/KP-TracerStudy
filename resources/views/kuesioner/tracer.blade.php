@extends('layoutadmin.layout')
@section('title', 'Kuesioner')
@section('active8')
      nav-item active
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kuesioner</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No.</th>
                    <th style="text-align:center;">Nama Alumni</th>
                    <th style="text-align:center;">Program Studi</th>
                    <th style="text-align:center;">Angkatan</th>
                    <th style="text-align:center;">Tahun Lulus</th>
                    <th style="text-align:center;">Pertanyaan</th> 
                    <th style="text-align:center;">Jawaban</th> 
                </tr>
                </thead>

                <tbody>
                @foreach($detail as $details)
                <tr class="success">
                    <td style="width: 1%;">{{ $loop->iteration }}</td>
                        <td style="width: 15%;">{{ $details->nama_alumni }}</td>
                        <td style="width: 10%;">{{ $details->nama_prodi }}</td>
                        <td style="width: 5%;" >{{ $details->tahun_angkatan }}</td>
                        <td style="width: 7%;" >{{ $details->tahun_lulus }}</td>
                        <td style="width: 20%;" >{{ $details->pertanyaan }}</td>
                        <td style="width: 10%" >{{ $details->jawaban }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection