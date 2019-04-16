<!-- LARGE MODAL -->
<div id="modal-add" class="modal fade">
<div class="modal-dialog modal-lg" role="document" style="width:500px;">
  <div class="modal-content tx-size-sm">
    <div class="modal-header pd-x-20">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Product</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="" data-url="/admin/product_detail" url-reload="/admin/product/detail/{{$product->id}}" id="form-add" method="POST" role="form" enctype= "multipart/form-data">
    
    <div class="modal-body pd-20">
    <h4 class=" lh-3 mg-b-20 tx-inverse hover-primary"></h4>
    <div class="form-group">
      <div class="row">
        <span class="col-md-12">
          <input type="text" name="code-add" id="code-add" class="form-control pd-y-12 " placeholder=" Code" >
        </span>
        <input type="hidden" name="product_id-add" id="product_id-add" value="{{$product->id}}" >
      
      </div>
      
    </div>
    <div class="form-group">
      <label for="">Color</label>
	    <select class="form-control pd-y-12" id="color-add" name="color-add">
        <option selected>CHOSSE COLOR</option>
        @foreach($colors as $row)
          <option value="{{ $row->id }}">{{ $row->value }}</option>
        @endforeach
      </select>
	  </div>
    <div class="form-group">
      <label for="">Size</label>
      <select class="form-control pd-y-12" id="size-add" name="size-add">
        <option selected>CHOSSE SIZE</option>
        @foreach($sizes as $row)
          <option value="{{ $row->id }}">{{ $row->value }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="">Số lượng</label>
      <input type="number" name="quantity-add" id="quantity-add" class="form-control pd-y-12" placeholder="Quantity?">
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