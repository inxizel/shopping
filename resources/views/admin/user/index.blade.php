@extends('layouts.admin')

@section('css')
<!-- vendor css -->
<link href="/admin_assets/lib/jquery-toggles/toggles-full.css" rel="stylesheet">
@endsection

@section('js')
<script src="/admin_assets/lib/jquery-toggles/toggles.min.js"></script>
<script>
  $( ".admin" ).addClass( "active" );
</script>
<script>
  $(function(){
    'use strict'

    // Toggles
    $('.toggle-off').toggles({
      on: false,
      height: 26
    });
    $('.toggle-on').toggles({
      on: true,
      height: 26
    });

  });
</script>



<script type="text/javascript">

  $('.btn-add').click(function(){
          
    $('#modal-add').modal('show');

    //bắt sự kiện submit form thêm mới
    $('#form-add').submit(function (e) {

      //var token = $('meta[name="csrf-token"]').attr('content');
      
      var data = new FormData();
      
      data.append('image', $('#image-add')[0].files[0]);
      data.append('name', $('#name-add').val());
      data.append('email', $('#email-add').val());
      data.append('mobile', $('#mobile-add').val());
      data.append('gender', $('#gender-add').val());
      data.append('status', $('#status-add').is(":checked"));

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
            window.location.href="/admin/user";
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
          name: $('#name-edit').val(),
          email: $('#email-edit').val(),
          mobile: $('#mobile-edit').val(),
          gender: $('#gender-edit').val(),
          status: $('#status-edit').is(":checked")
        },
        success: function (response) {
          // hiện thông báo thêm mới thành công bằng toastr
          console.log(response);
          toastr.success('Edit success!' );
          //ẩn modal add đi
          $('#modal-edit').modal('hide');
          setTimeout(function () {
            window.location.href="/admin/user";
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
      url : '/admin/user/' + id,
      data: {
        _method : 'delete'
      },
      success : function(res){
        toastr.success('Delete success!')
        setTimeout(function () {
          window.location.href="/admin/user";
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
    <button class="btn btn-primary btn-block mg-b-10 btn-add"><i class="fa fa-send mg-r-10"></i>Add New</button>
    <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="wd-5p">ID</th>
          <th class="wd-10p">Display Name</th>
          <th class="wd-5p">Gender</th>
          <th class="wd-15p">Email</th>
          <th class="wd-10p">Mobile</th>
          <th class="wd-5p">Status</th>
          <th class="wd-10p">Created At</th>
          <th class="wd-10p">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $row)
        <tr>
          <td>{{$row->id}}</td>
          <td>{{$row->name}}</td>
          <td>
            <a href="#" class="success">
              <div> 
                @if($row->gender == 1) <i class="fa fa-mars"></i> 
                @elseif($row->gender == 0) <i class="fa fa-venus" style="color: #de4453;"></i>
                @else <i class="fa fa-transgender-alt" style="color: #23bf08;"></i>
                @endif
              </div>
            </a>
          </td>
          <td>{{$row->email}}</td>
          <td><b>{{$row->mobile}}</b></td>
          <td>
            <div class="toggle-wrapper">
              <div class="@if($row->status == 'on') toggle-on @else toggle-off @endif  toggle-light success"></div>
            </div>
          </td>
          <td>{{ $row->created_at }}</td>      
          <td>
            <a href="javascript:;" class="btn btn-outline-primary btn-icon mg-r-5 btn-edit" data-id="{{$row->id}}"> 
              <div><i class="fa fa-pencil"></i></div>
            </a>
            <a href="javascript:;" class="btn btn-outline-danger btn-icon mg-r-5 btn-delete" data-id="{{$row->id}}">
              <div><i class="fa fa-trash-o"></i></div>
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

  @include('admin.user.modal.add')
  @include('admin.user.modal.edit')

@endsection