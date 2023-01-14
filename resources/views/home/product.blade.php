{{-- @include('sweetalert::alert') --}}

<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <br><br>
            <div>
                <form action="{{ url('product_search') }}" method="get">
                    @csrf
                    <input type="text" style="color: skyblue;width:800px;" name="search"
                        placeholder="Search For Something">
                    <input type="submit" style="font-size: 15px; background-color:skyblue" value="search"
                        class="btn btn-outline-primary">
                </form>
            </div>

        </div>
        <div class="row">

            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('prouduct_details', $products->id) }}" class="option1">
                                    Product Details
                                </a>
                                <form action="{{ url('add_cart', $products->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4" style="width: 100px">
                                            <input type="number" name="quantity" value="1" min="1">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Add To Cart">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $products->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $products->title }}
                            </h5>
                            @if ($products->discount_price != null)
                                <h6 style="text-decoration: line-through; color:skyblue">
                                    Price
                                    <br>
                                    ${{ $products->price }}
                                </h6>

                                <h6 style="color: red">
                                    Discount Price
                                    <br>
                                    ${{ $products->discount_price }}
                                </h6>
                            @else
                                <h6 style="color: skyblue">
                                    Price
                                    <br>
                                    ${{ $products->price }}
                                </h6>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
            <span style="padding-top: 20px;">
                {!! $product->withquerystring()->links('pagination::bootstrap-5') !!}
            </span>
        </div>
        <script>


// when add product to cart refresh page and go again to products section with scrollable
            document.addEventListener("DOMContentLoaded", function(event) {
                var scrollpos = localStorage.getItem('scrollpos');
                if (scrollpos) window.scrollTo(0, scrollpos);
            });

            window.onbeforeunload = function(e) {
                localStorage.setItem('scrollpos', window.scrollY);
            };
        </script>
</section>
