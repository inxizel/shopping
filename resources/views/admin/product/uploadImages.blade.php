@extends('layouts.admin')
@section('main')

<div class="br-mainpanel" style="margin-top: 40px;">
	<form action="/admin/product-image" class="dropzone" id="myDropzone">
		@csrf
	  <div class="fallback">
	    <input name="file" type="file" multiple />
	  </div>
	</form>
	<button type="button" class="btn btn-default" id="btn-add">Save</button>
	<style type="text/css" media="screen">
		.dropzone {
		border: 2px dashed #0087F7;
		border-radius: 5px;
		background: white;		

		}
	</style>
</div>
@endsection
@section('js')
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