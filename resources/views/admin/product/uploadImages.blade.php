@extends('layouts.admin')
@section('main')

<div class="br-mainpanel" >
  	
  <div class="br-pageheader pd-y-15 pd-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="index.html">Bracket</a>
      <a class="breadcrumb-item" href="#">UI ELements</a>
      <span class="breadcrumb-item active">Spinners</span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
    <h4 class="tx-gray-800 mg-b-5">Spinners</h4>
    <p class="mg-b-0">A collection of loading indicators animated with CSS.</p>
  </div>

  <div class="br-pagebody">
  	<form action="/admin/product-image" class="dropzone" id="myDropzone">
	  @csrf
	  <input type="hidden" name="product_id" value="{{$id}}">
	  <div class="fallback">
	    <input name="file" type="file" multiple />
	  </div>
	</form>
	<button type="button" class="btn btn-primary btn-block mg-b-10 btn-add" id="btn-add"><i class="fa fa-send Save-10"></i> Add New Images</button>


    <div class="br-section-wrapper" >
      <div class="row">
      	@foreach($images as $row)
        <div class="col-md-6 col-xl-4">
          <div class="d-flex bg-gray-200 ht-600 pos-relative align-items-center">
            <image src="/storage/{{$row->image}}" width="100%"/>
          </div><!-- d-flex -->
        </div><!-- col-4 -->  
        @endforeach      
      </div><!-- row -->




    </div><!-- br-section-wrapper -->
  </div><!-- br-pagebody -->
  <footer class="br-footer">
    <div class="footer-left">
      <div class="mg-b-2">Copyright &copy; 2017. Bracket. All Rights Reserved.</div>
      <div>Attentively and carefully made by ThemePixels.</div>
    </div>
    <div class="footer-right d-flex align-items-center">
      <span class="tx-uppercase mg-r-10">Share:</span>
      <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
      <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
    </div>
  </footer>
</div><!-- br-mainpanel -->


</div>
@section('css')
<style type="text/css" media="screen">
	.dropzone {
	border: 2px dashed #0087F7;
	border-radius: 5px;
	background: white;		

	}
</style>
	
@endsection

@section('js')
	<script>
	  $( ".product" ).addClass( "active show-sub" );
	</script>
	<script>
		Dropzone.options.myDropzone = {
		    maxFileSize : 4,
		    parallelUploads : 10,
		    uploadMultiple: true,
		    autoProcessQueue : false,
		    addRemoveLinks : true,
		    init: function() {
		        var submitButton = document.querySelector("#btn-add")
		        myDropzone = this;
		        submitButton.addEventListener("click", function() {
		            myDropzone.processQueue(); 
		        });
		        
		    },
		};
	</script>
@endsection