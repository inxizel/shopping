@extends('layouts.shop')

@section('css')
<!-- vendor css -->

@endsection

@section('js')
<script type="text/javascript">
	$('.upQty').click(function () {
		
		var rowId = $(this).attr('data-id');

		var data = new FormData();
		data.append('rowId', rowId);

		var url = 'cart/upQty';
		$.ajax({
	        //sử dụng phương thức post
	        type: 'post',
	        url: url,
	        processData: false,
	        contentType: false,
	        data: data,
	        success: function (response) {
	          // hiện thông báo thêm mới thành công bằng toastr
	          $
	          console.log(response);
	        },
	        error: function (jqXHR, textStatus, errorThrown) {
	          //xử lý lỗi tại đây
	        }
	    })
	})
</script>
@endsection


@section('main')
<!--================Home Banner Area =================-->
<section class="banner_area">
	<div class="banner_inner d-flex align-items-center">
		<div class="container">
			<div class="banner_content text-center">
				<h2>Shopping Cart</h2>
				<div class="page_link">
					<a href="index.html">Home</a>
					<a href="cart.html">Cart</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
	<div class="container">
		<div class="cart_inner">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Product</th>
							<th scope="col">Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Size</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($carts as $cart)
						<tr>
							<td>
								<div class="media">
									<div class="d-flex">
										<img src="/storage/{{$cart->options->thumbnail}}" alt="">
									</div>
									<div class="media-body">
										<p>{{$cart->name}}</p>
									</div>
								</div>
							</td>
							<td>
								<h5>{{number_format($cart->price)}} vnđ</h5>
							</td>
							<td>
								<div class="product_count">
									<input type="text" name="qty" id="sst" maxlength="12" value="{{$cart->qty}}" class="input-text qty">
									<button	 class="increase items-count upQty" type="button"  data-id="{{$cart->rowId}}" >
										<i class="lnr lnr-chevron-up"></i>
									</button>
									<button class="reduced items-count downQty" type="button"  data-id="{{$cart->rowId}}" >
										<i class="lnr lnr-chevron-down"></i>
									</button>
								</div>
							</td>
							<td>
								<h5>{{$cart->options->size}}</h5>
							</td>
							<td>
								<h5>{{number_format($cart->qty * $cart->price)}} vnđ</h5>
							</td>
						</tr>
						@endforeach
						
						<tr class="bottom_button">
							<td>
								<a class="gray_btn" href="#">Update Cart</a>
							</td>
							<td>

							</td>
							<td>

							</td>
							<td>
								<div class="cupon_text">
									<input type="text" placeholder="Coupon Code">
									<a class="main_btn" href="#">Apply</a>
									<a class="gray_btn" href="#">Close Coupon</a>
								</div>
							</td>
						</tr>
						<tr>
							<td>

							</td>
							<td>

							</td>
							<td>
								<h5>Subtotal</h5>
							</td>
							<td>
								<h5>$2160.00</h5>
							</td>
						</tr>
						<tr class="shipping_area">
							<td>

							</td>
							<td>

							</td>
							<td>
								<h5>Shipping</h5>
							</td>
							<td>
								<div class="shipping_box">
									<ul class="list">
										<li>
											<a href="#">Flat Rate: $5.00</a>
										</li>
										<li>
											<a href="#">Free Shipping</a>
										</li>
										<li>
											<a href="#">Flat Rate: $10.00</a>
										</li>
										<li class="active">
											<a href="#">Local Delivery: $2.00</a>
										</li>
									</ul>
									<h6>Calculate Shipping
										<i class="fa fa-caret-down" aria-hidden="true"></i>
									</h6>
									<select class="shipping_select">
										<option value="1">Bangladesh</option>
										<option value="2">India</option>
										<option value="4">Pakistan</option>
									</select>
									<select class="shipping_select">
										<option value="1">Select a State</option>
										<option value="2">Select a State</option>
										<option value="4">Select a State</option>
									</select>
									<input type="text" placeholder="Postcode/Zipcode">
									<a class="gray_btn" href="#">Update Details</a>
								</div>
							</td>
						</tr>
						<tr class="out_button_area">
							<td>

							</td>
							<td>

							</td>
							<td>

							</td>
							<td>
								<div class="checkout_btn_inner">
									<a class="gray_btn" href="#">Continue Shopping</a>
									<a class="main_btn" href="#">Proceed to checkout</a>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<!--================End Cart Area =================-->


@endsection