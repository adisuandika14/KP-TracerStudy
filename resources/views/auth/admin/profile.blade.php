@extends('layoutadmin.layout')
@section('title', 'Profile Admin')

@section('content')
<style type="text/css">
img {
  display: block;
  max-width: 100%;
}
.preview {
  overflow: hidden;
  width: 160px; 
  height: 160px;
  margin: 10px;
  border: 1px solid red;
}
.modal-lg{
  max-width: 1000px !important;
}

</style>

<!-- Begin Page Content -->
<div class="container-fluid" >

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        
    </div>


    <!-- Content Row -->
    <div class="row" >

        <!-- Content Column -->
        <div class="col-lg-6 mb-4" style="margin-left: 400px;">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
                </div>
                <div class="card-body">
                    <div class="profile-info-inner">
                        <div class="profile-img" >
                            <img style="margin-left: 200px;" class="img-profile rounded-circle" src="{{asset('assets/admin/img/guest.png')}}" height="300px" width="300px" alt="Avatar" >
                            <form method="POST" action="/admin/auth/profile/update" enctype="multipart/form-data" style="margin-left: 150px;">
                            @csrf
                                <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                    <input type="file" name="file" class="image" id="foto">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </div>
                        <div style="margin-left: 150px;">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>Nama</b><br /><input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" placeholder=" Masukkan Nama Lengkap"> </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                        <p><b>Email</b><br /> {{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <p><b>No. Tlp</b><br /> +62 {{Auth::user()->no_tlp}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="address-hr">
                                        <p><b>Address</b><br /> E104, catn-2, Chandlodia Ahmedabad Gujarat, UK.</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        
    </div>

</div>



<!-- Modal Crop -->

<!-- <div class="container">
    <h1>Laravel Crop Image Before Upload using Cropper JS - NiceSnippets.com</h1>
    <input type="file" name="image" class="image">
</div> -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Pangkas Foto Anda Sesuai dengan Ukuran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
            <div class="row">
                <div class="col-md-8">
                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                </div>
                <div class="col-md-4">
                    <div class="preview"></div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>


<script>

var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
  
$("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
	  aspectRatio: 1,
	  viewMode: 3,
	  preview: '.preview'
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
	    width: 300,
	    height: 400,
      });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob); 
         reader.onloadend = function() {
            var base64data = reader.result;	

            $.ajax({
                //type: "POST",
                //dataType: "json",
                // url: "crop-image-upload",
                // data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
                success: function(data){
                    $modal.modal('hide');
                    alert("success crop image");
                }
              });
         }
    });
})

</script>


@endsection