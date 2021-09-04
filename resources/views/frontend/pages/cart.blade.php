@extends('frontend.master')
@section('main')

<main id="main">
	<div class="container">
		<ul class="breadcrumb__global">
			<li>
				<a href="index.html" title="trang chủ">
				Trang chủ
				</a>
			</li>
			<li>
				<a href="page__cart.html" title="Giỏ hàng">
				Giỏ hàng
				</a>
			</li>
		</ul>
	</div>
	<section class="page__cart">
		<div class="container">
			<div class="module module-page__cart">
				<div class="module__header">
					<h2 class="title">Giỏ hàng của bạn</h2>
				</div>
				@if (Cart::count())
				<div class="module__content">
					<div class="cart__table">
						<div class="table__res">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">Sản phẩm</th>
										<th scope="col">Thuộc tính</th>
										<th scope="col">Số lượng</th>
										<th scope="col">Giá</th>
									</tr>
								</thead>
								
								<tbody>
									@foreach(Cart::content() as $item)
									<tr class="cart-group_{{$item->rowId}}">
										<td>
											<a href="{{route('home.single.product',['slug'=>$item->options->slug])}}" class="cart__product" title="cart__product-avata">
												<div class="cart__product-avata">
													<div class="frame">
														<img src="{{url('/').@$item->options->image}}" alt="{{$item->name}}"/>
													</div>
												</div>
												<h3 class="cart__product--title">
													{{$item->name}}
												</h3>
											</a>
										</td>
										<td>
											{{@$item->options->volume}}
											<span class="pr__color" style="background-color:{{$item->options->color}}" title="màu sắc"></span>
										</td>
										<td>
											<input type="number" name="qty"  min="0" data-id="{{$item->rowId}}" value="{{$item->qty}}"/>
										</td>
										<td>
											<div class="price">
												<span>
													{{ number_format($item->price, 0, '.', '.') }}VND
												</span>
												<button class="btn btn__delete btn__delete_cart_item" data-rowid="{{$item->rowId}}" data-type="1">
												Xóa
												</button>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="cart__invoice">
							<div class="cart__invoice-item">
								<div class="cart__invoice-name">Tạm tính</div>
								<div class="cart__invoice__total cart__total-number">
								{{number_format(Cart::total(), 0, '.', '.')}}VND
								</div>
							</div>
							<!-- <div class="cart__invoice-item">
								<div class="cart__invoice-name">
									Phí vận chuyển
									<i class="fa fa-question-circle" aria-hidden="true"></i>
								</div>
								<div class="cart__invoice__total">
									200.000
								</div>
							</div> -->
							<div class="cart__invoice-item cart--total">
								<div class="cart__invoice-name">Tổng tiền</div>
								<div class="cart__invoice__total cart__total-number">
								{{number_format(Cart::total(), 0, '.', '.')}}VND
								</div>
							</div>
							<a href="{{route('home.check-out1')}}" class="btn btn__cart-play">
							Thanh toán
							</a>
						</div>
					</div>
				</div>
				@else
				<div class="module__content" style="text-align: center;background: 
		                    #d4edda;padding: 30px">
		                        Không có sản phẩm nào trong giỏ hàng
		                    </div>
				@endif
			</div>
		</div>
	</section>
</main>
	@section('script')
		<script type="text/javascript">
			$('.btn-check-out').click(function(e){
				e.preventDefault();

				$('.fr-error').html('');

				$('.loadingcover').show();

			    var Url =$('#formsreviews').attr('action');

			    var data = $("#formsreviews").serialize();

			    $.ajax({

			        type: 'POST',

			        url: Url,

			        dataType: "json",

			        data: data,

			        success: function(data) {

		                $('.loadingcover').hide();

		                if(data.success){

		                    toastr["success"](data.success, "");

		                    $('.box_content').html(data.html_response);

		                    $('.count-cart').html('0');

		                    $('#formsreviews')[0].reset();

		                }

		                if(data.error_cart_count){
		                	toastr["error"](data.error_cart_count, "Thông báo");
		                }

		                if(data.error.name){

		                    $('.name_error').html(data.error.name);

		                }

		                if(data.error.phone){

		                    $('.phone_error').html(data.error.phone);

		                }

		                if(data.error.address){

		                    $('.address_error').html(data.error.address);

		                }

		                if(data.error.note){

		                    $('.note_error').html(data.error.note);

		                }

                        if(data.status==3){
                            toastr["error"](data.error, "Thông báo");
                        }

		            },
		            error: function (jqXHR, exception) {
		                $('.loadingcover').hide();
		            }

			    });
			});
		</script>
	@endsection

@endsection