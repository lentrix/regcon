@extends('base')

@section('headers')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

@endsection

@section('content')

<style type="text/css">
    img {
      display: block;
      max-width: 100%;
    }

    .preview {
      overflow: hidden;
      width: 200px;
      height: 200px;
      margin: 10px;
      border: 1px solid red;
    }

    .modal-lg{
      max-width: 1000px !important;
    }
    .image {
        display: none;
    }
    #upload-img {

    }
</style>

@include("users.change-password-modal")
@include("users.edit-modal")
@include("partials.cropper-modal")

<div class="row">
    <div class="col-md-3" id="img-area" style="position: relative">
        <img src="{{$user->imgUrl}}" alt="" class="profile-pic margin: auto"> <br>
        <input type="file" name="image" class="image">
        <button id="upload-img"
                title="Upload a new profile picture"
                class="btn btn-sm btn-info"
                style="position: absolute; bottom:23px; right: 118px; visibility: hidden">
            <i class="fa fa-camera"></i>
        </button>
    </div>
    <div class="col-md-4">
        <div style="font-size: 1.6em; font-weight: bold; text-transform: uppercase">
            {{$user->fname}} {{$user->lname}}
        </div>
        <div style="font-style: italic">{{$user->designation}}</div>
        <div>{{$user->school}}</div>
        <div>{{$user->email}}</div>
        <div>

            <button class="btn btn-info btn-sm" type="button" title="Edit Profile"
                    data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-warning btn-sm" type="button" title="Change password"
                    data-bs-toggle="modal" data-bs-target="#changePassModal">
                <i class="fa fa-lock"></i>
            </button>
            @if($user->role=='admin' || $user->role=='moderator')
            <a href="{{url('/admin/')}}" class="btn btn-secondary btn-sm" title="Admin Page">
                <i class="fa fa-cog"></i>
            </a>
            @endif
        </div>
    </div>

    <?php
        $part = $user->currentParticipation;
        $nom = $part->nominations;
    ?>
    @if($part && count($nom)>0 && $part->candidate==null)
    <div class="col-md-5">
        <div class="alert alert-success">
            <p style="font-weight: bold; font-size: 1.2em">You have been nominated as an officer!</p>

            @if($part->nomination_response==null)
            <p>
                Please ACCEPT or DECLINE your nomination. If there is no response
                at the end of the nomination period, it will be assumed as DECLINED.
            </p>
            <div class="d-flex justify-content-between">
                {!! Form::open(['url'=>'/election/nomination-response','method'=>'post','style'=>'width: 45%']) !!}
                    {!! Form::hidden('nomination_id', $part->id) !!}
                    {!! Form::hidden('response', "accepted") !!}
                    <button class="btn btn-primary btn-block" type="submit">
                        <i class="fa fa-check"></i> Accept
                    </button>
                {!! Form::close() !!}

                {!! Form::open(['url'=>'/election/nomination-response','method'=>'post','style'=>'width: 45%']) !!}
                    {!! Form::hidden('nomination_id', $part->id) !!}
                    {!! Form::hidden('response', "declined") !!}
                    <button class="btn btn-danger btn-block" type="submit">
                        <i class="fa fa-ban"></i> Decline
                    </button>
                {!! Form::close() !!}
            </div>
            @elseif($part->nomination_response=="accepted")
                Thank you for accepting your nomination. We will go over your profile and
                membership history to determine whether you are qualified to be a candidate.
            @else
                Thank you for your response. We respect that you declined your nomination.
            @endif

        </div>
    </div>
    @endif

    @if($part && $part->candidate)

        <div class="col-md-5">
            <div class="alert alert-success">
                <strong>Congratulations!</strong> You have qualified to be a candidate for the
                PSITE-7 Regional Officer's Election of 2021. You may now start your campaign. <br>
                GOOD LUCK!
            </div>
        </div>

    @endif
</div>

<hr>

<h4>Bulletin of Information</h4>

@endsection

@section('scripts')

<script>
$(document).ready(function(){
    $("#upload-img").click(function(){
        $(".image").trigger('click');
    })

    $("#img-area").hover(function(){
        $("#upload-img").css('visibility', 'visible');
    }).mouseleave(function(){
        $("#upload-img").css('visibility','hidden');
    })

    $(".close-modal").click(function(){
        $("#modal").modal('hide');
    })
});

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
    console.log("Cropping...");

    canvas = cropper.getCroppedCanvas({
	    width: 200,
	    height: 200,
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
         reader.readAsDataURL(blob);
         reader.onloadend = function() {
            var base64data = reader.result;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "image-cropper/upload",
                data: {'image': base64data},
                success: function(data){
                    $modal.modal('hide');
                    $(".profile-pic").attr('src', base64data);
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
              });
         }
    });
})

</script>
@endsection
