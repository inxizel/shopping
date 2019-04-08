<!-- LARGE MODAL -->
<div id="modal-edit" class="modal fade">
<div class="modal-dialog modal-lg" role="document" style="width:500px;">
  <div class="modal-content tx-size-sm">
    <div class="modal-header pd-x-20">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Admin</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" data-url="/admin/user" id="form-edit" method="POST" role="form" enctype= "multipart/form-data">
    
    <div class="modal-body pd-20">
    <h4 class=" lh-3 mg-b-20 tx-inverse hover-primary"></h4>
    <div class="form-group">
      <label for="">Name</label>
      <input type="text" name="name-edit" id="name-edit" class="form-control pd-y-12" placeholder="Your Name">
    </div>
    <div class="form-group">
      <label for="">Email</label>
	    <input type="email" name="email-edit" id="email-edit" class="form-control pd-y-12" placeholder="Your Email(*)">
	  </div>
    <div class="form-group">
      <label for="">Moblie</label>
      <input type="text" name="mobile-edit" id="mobile-edit" class="form-control pd-y-12" placeholder="Your Mobile">
    </div>

    
	  <div class="form-group">
      <label for="">Gender</label>
      <select class="form-control" id="gender-edit">
        <option value="1" >Male</option>
        <option value="0" >Famale</option>
        <option value="-1">None</option>
      </select>
    </div>

	  <div class="form-group">
		  <label class="ckbox ckbox-success mg-t-15">
		    <input type="checkbox" checked="" id="status-edit" name="status-edit"><span>Kích Hoạt?</span>
		  </label>
	  </div>
	  <div class="form-group">
	    <input type="file" class="form-control" id="image-edit" placeholder="image" >
	  </div>
	  
    </div><!-- modal-body -->
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary tx-size-xs">Save changes</button>
      <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
    </div>
    </form>
  </div>
</div><!-- modal-dialog -->
</div><!-- modal -->