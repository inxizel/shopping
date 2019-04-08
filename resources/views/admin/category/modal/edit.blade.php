<!-- LARGE MODAL -->
<div id="modal-edit" class="modal fade">
<div class="modal-dialog modal-lg" role="document" style="width:500px;">
  <div class="modal-content tx-size-sm">
    <div class="modal-header pd-x-20">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Category</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" data-url="/admin/category" id="form-edit" method="POST" role="form" enctype= "multipart/form-data">
    
    <div class="modal-body pd-20">
    <h4 class=" lh-3 mg-b-20 tx-inverse hover-primary"></h4>
    <div class="form-group">
      <label id="slug-edit-title" style="display: none; " for="">Permalink: <span style="color: #17a2b8;">http://domain.com/<span id="slug-edit" name="slug-edit"></span></span></label>
      <input type="text" name="name-edit" id="name-edit" class="form-control pd-y-12" placeholder="Category Name">
    </div> 
    <div class="form-group">
      <textarea rows='10' id='description-edit' name='description-edit' class="form-control pd-y-12" placeholder="Description..."></textarea>
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