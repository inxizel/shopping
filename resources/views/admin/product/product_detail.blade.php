@extends('layouts.admin')

@section('css')
<!-- vendor css -->

@endsection

@section('js')
<script>
  $( ".product" ).addClass( "active show-sub" );
</script>
<script language="javascript">
  function ChangeToSlug()
  {
      var title, slug;

      //Lấy text từ thẻ input title 
      title = document.getElementById("name-add").value;

      //Đổi chữ hoa thành chữ thường
      slug = title.toLowerCase();

      //Đổi ký tự có dấu thành không dấu
      slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
      slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
      slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
      slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
      slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
      slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
      slug = slug.replace(/đ/gi, 'd');
      //Xóa các ký tự đặt biệt
      slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
      //Đổi khoảng trắng thành ký tự gạch ngang
      slug = slug.replace(/ /gi, "-");
      //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
      //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
      slug = slug.replace(/\-\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-\-/gi, '-');
      slug = slug.replace(/\-\-\-/gi, '-');
      slug = slug.replace(/\-\-/gi, '-');
      //Xóa các ký tự gạch ngang ở đầu và cuối
      slug = '@' + slug + '@';
      slug = slug.replace(/\@\-|\-\@|\@/gi, '');
      //In slug ra textbox có id “slug”
      return slug;
  }

  $("#name-add").change(function(){
    var slug = 'Permalink: <span  style=\"color: #17a2b8;\">http://domain.com/'+ChangeToSlug()+'</span>' ;
    //alert(slug);
    $("#slug").html(slug);
    $("#slug-add").val(ChangeToSlug());

  });
</script>



<script >
  $('.btn-add').click(function(){
          
    $('#modal-add').modal('show');

    //bắt sự kiện submit form thêm mới
    $('#form-add').submit(function (e) {
      
      var data = new FormData();
      
      //data.append('image', $('#image-add')[0].files[0]);
      data.append('name', $('#name-add').val());
      data.append('description', $('#description-add').val());
      data.append('slug', $('#slug-add').val());
      data.append('product_code', $('#code-add').val());
      data.append('brand', $('#brand-add').val());
      data.append('category', $('#category-add').val());
      data.append('price', $('#price-add').val());
    
      e.preventDefault();
      //lấy attribute data-url của form lưu vào biến url
      var url = $(this).attr('data-url');
    
      $.ajax({
        //sử dụng phương thức post
        type: 'post',
        url: url,
        processData: false,
        contentType: false,

        data: data,
        success: function (response) {
          // hiện thông báo thêm mới thành công bằng toastr
          toastr.success('Add new success!')
          //ẩn modal add đi
          $('#modal-add').modal('hide');

          console.log(response);
          setTimeout(function () {
            window.location.href="/admin/product";
          },800);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          //xử lý lỗi tại đây
        }
      })
    })
  });
  $('.btn-edit').click(function(){
    var id = $(this).data('id');
    $.ajax({
      type: 'get',
      url : '/admin/user/' + id,
      success : function(res){
        // add url post update
        $('#form-edit').attr('data-url','{{ asset('admin/user') }}/'+ res.id);


        $('#email-edit').val(res.email);
        $('#name-edit').val(res.name);
        $('#mobile-edit').val(res.mobile);

        // Delete attr selected option jquery
        $("#gender-edit").children().removeAttr("selected");
        // Add attr selected jquery
        $("#gender-edit option[value=" + res.gender + "]").attr('selected', 'selected');
        
        // Delete checked input default
        $('#status-edit').removeAttr('checked');

        if(res.status == 'on') $('#status-edit').prop('checked', true);
        //$('#quantity-edit').val(res.quantity);
      }
    })
    $('#modal-edit').modal('show');

    //bắt sự kiện submit form thêm mới
    $('#form-edit').submit(function (e) {
      e.preventDefault();
      //lấy attribute data-url của form lưu vào biến url
      var url = $(this).attr('data-url');

    
      $.ajax({
        //sử dụng phương thức post
        type: 'put',
        url: url,
        data: {
          //lấy dữ liệu từ ô input trong form thêm mới
          code: $('#code-edit').val(),
          name: $('#name-edit').val(),
          price: $('#price-edit').val(),
          quantity: $('#quantity-edit').val()
        },
        success: function (response) {
          // hiện thông báo thêm mới thành công bằng toastr
          console.log(response);
          toastr.success('Edit success!' );
          //ẩn modal add đi
          $('#modal-edit').modal('hide');
          setTimeout(function () {
            window.location.href="/product";
          },1000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          //xử lý lỗi tại đây
        }
      })
    })
  });
  $('.btn-delete').click(function(){

    var id = $(this).data('id');
    $.ajax({
      type: 'post',
      url : '/admin/product/' + id,
      data: {
        _method : 'delete'
      },
      success : function(res){
        toastr.success('Delete success!')
        setTimeout(function () {
          window.location.href="/admin/product";
        },800);
      }
    })
  });  

  function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadPreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#image-add").change(function(){
      readURL(this);
  });

</script>
@endsection


@section('main')

<div class="br-mainpanel" style="margin-top: 40px;">

<div class="br-pageheader pd-y-15 pd-l-20">
  <nav class="breadcrumb pd-0 mg-0 tx-12">
    <a class="breadcrumb-item" href="index.html">Bracket</a>
    <a class="breadcrumb-item" href="#">Forms</a>
    <span class="breadcrumb-item active">Form Elements</span>
  </nav>
</div>
<div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
  <h4 class="tx-gray-800 mg-b-5">Form Elements</h4>
  <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
</div>
<div class="br-pagebody">
  <div class="br-section-wrapper">
    <a href="/admin/product"><button class="btn btn-primary btn-block mg-b-10 btn-add"><i class="fa fa-send mg-r-10"></i>Back Product List</button></a>
    <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="wd-5p">ID</th>
          <th class="wd-5p">Code</th>
          <th class="wd-15p">Name</th>
          <th class="wd-5p">Category</th>
          <th class="wd-5p">Brand</th>
          <th class="wd-5p">Price</th>
          <th class="wd-10p">Created At</th>
          <th class="wd-15p">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->product_code}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->category_name}}</td>
          <td>{{$row->brand_name}}</td>
          <td><b>{{number_format($row->price)}}</b><sup>vnd</sup></td>
          <td>{{ $row->created_at }}</td>      
          <td>
            <a href="javascript:;" class="btn btn-outline-primary btn-icon mg-r-5 btn-edit" data-id="{{$row->id}}"> 
              <div><i class="fa fa-pencil"></i></div>
            </a>
            <a href="javascript:;" class="btn btn-outline-danger btn-icon mg-r-5 btn-delete" data-id="{{$row->id}}">
              <div><i class="fa fa-trash-o"></i></div>
            </a>
            <a href="/admin/product-image" class="btn btn-outline-success btn-icon mg-r-5" data-id="{{$row->id}}">
              <div><i class="fa fa-file-image-o"></i></div>
            </a>
            <a href="/admin/product-image" class="btn btn-outline-warning btn-icon mg-r-5" data-id="{{$row->id}}">
              <div><i class="fa fa-puzzle-piece"></i></div>
            </a>
            
          </td>   
        </tr>
        
      </tbody>
    </table>

    {{-- List Detail --}}
    <button class="btn btn-primary btn-block mg-b-10 btn-add"><i class="fa fa-send mg-r-10"></i>Add New</button>
    <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="wd-5p">ID</th>
          <th class="wd-5p">Code</th>
          <th class="wd-15p">Size</th>
          <th class="wd-5p">Color</th>
          <th class="wd-5p">Quantity</th>
          <th class="wd-10p">Created At</th>
          <th class="wd-15p">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->product_code}}</td>
          <td>{{$row->size_name}}</td>
          <td>{{$row->color_name}}</td>
          <td>{{$row->quantity}}</td>
          <td>{{ $row->created_at }}</td>      
          <td>
            <a href="javascript:;" class="btn btn-outline-primary btn-icon mg-r-5 btn-edit" data-id="{{$row->id}}"> 
              <div><i class="fa fa-pencil"></i></div>
            </a>
            <a href="javascript:;" class="btn btn-outline-danger btn-icon mg-r-5 btn-delete" data-id="{{$row->id}}">
              <div><i class="fa fa-trash-o"></i></div>
            </a>
            <a href="/admin/product-image" class="btn btn-outline-success btn-icon mg-r-5" data-id="{{$row->id}}">
              <div><i class="fa fa-file-image-o"></i></div>
            </a>
            <a href="/admin/product/{{$row->id}}" class="btn btn-outline-warning btn-icon mg-r-5" data-id="{{$row->id}}">
              <div><i class="fa fa-puzzle-piece"></i></div>
            </a>
            
          </td>   
        </tr>
        @endforeach
        
      </tbody>
    </table>

  </div>
</div>

<footer class="br-footer">
  <div class="footer-left">
    <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
    <div>Attentively and carefully made by ThemePixels.</div>
  </div>
  <div class="footer-right d-flex align-items-center">
    <span class="tx-uppercase mg-r-10">Share:</span>
    <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
    <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
  </div>
</footer>

</div>  


@endsection