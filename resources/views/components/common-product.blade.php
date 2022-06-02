<div class="box">
    <a href="{{ route('show-product', $product->id) }}">
        <div class="img-box">
            @if(count($product->images) < 1)
                <img src="{{ asset('images/alt-product.png') }}" alt="">
            @else
                <img src="{{ asset('storage/'.$product->images[0]["image_url"]) }}" alt="">
            @endif
        </div>
        <div class="detail-box">
            <h6>
                {{ $product->product_title }}
            </h6>
            <h6>
                Base Price:
                <span>৳{{ $product->product_base_price }}</span>
            </h6>
        </div>
        <div>
            @if($product->product_category)
                <span>
                    Category: {{
                        \Illuminate\Support\Facades\DB::table('categories')->where('id', $product->product_category)->first()->title
                    }}
                </span>
            @else
                <span>
                    Category: N/A
                </span>
            @endif

        </div>
        @if($product->product_status === \App\Enums\ProductStatusEnum::Available()->value)
            <div class="new">
                <span>{{ $product->product_status }}</span>
            </div>
        @elseif($product->product_status === \App\Enums\ProductStatusEnum::Deactivated()->value )
            <div class="new bg-danger">
                <span>{{ $product->product_status }}</span>
            </div>
        @else
            <div class="new bg-success">
                <span>{{ $product->product_status }}</span>
            </div>
            @if($product->buyer)
                <div class="w-100 p-2 my-2" style="border-radius: 10px; background: #dbd2db">
                    <p class="mb-0">Winner: {{ $product->buyer->name }}</p>
                    <span>Email : {{ $product->buyer->email ?? 'N/A' }}</span>
                    <p>Price : ৳ {{ $product->product_sold_price ?? 'N/A' }}</p>
                </div>
            @endif

        @endif
    </a>
</div>

