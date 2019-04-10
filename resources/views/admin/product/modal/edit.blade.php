<!-- LARGE MODAL -->
<div id="modal-edit" class="modal fade">
<div class="modal-dialog modal-lg" role="document" style="width:500px;">
  <div class="modal-content tx-size-sm">
    <div class="modal-header pd-x-20">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Product</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" data-url="" id="form-edit" method="POST" role="form" enctype= "multipart/form-data">
    
    <div class="modal-body pd-20">
    <h4 class=" lh-3 mg-b-20 tx-inverse hover-primary"></h4>
    <div class="form-group">
      <label id="slug" for=""></label>
      <div class="row">
        <span class="col-md-3">
          <input type="text" name="code-edit" id="code-edit" class="form-control pd-y-12 " placeholder=" Code" >
        </span>
        <input type="text" name="name-edit" id="name-edit" class="form-control pd-y-12 col-md-9" placeholder="Product Name" >
      </div>
      
    </div>
    <div class="form-group">
      <textarea rows='10' id='description-edit' name='description-edit' class="form-control pd-y-12" placeholder="Description..."></textarea>
    </div>
    <div class="form-group">
      <label for="">Brand</label>
      <select class="form-control pd-y-12" id="brand-edit" name="brand-edit">
        <option>CHOSSE BRAND</option>
        @foreach($brands as $row)
          <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="">Category</label>
      <select class="form-control pd-y-12" id="category-edit" name="category-edit">
        <option>CHOSSE CATEGORY</option>
        @foreach($categories as $row)
          <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="">Price</label>
      <input type="number" name="price-edit" id="price-edit" class="form-control pd-y-12" placeholder="Price?">
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