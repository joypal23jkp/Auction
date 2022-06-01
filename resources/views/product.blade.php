@extends('layouts.app')

@section('content')
 <section class="about_section layout_padding">
     <div class="container">
         <div class="row">
             <div class="col-md-6 col-lg-5 ">
                 <div class="img-box">
                     <img src="{{ asset('storage/'.$product->images[0]["image_url"]) }}" alt="">
                 </div>
             </div>
             <div class="col-md-6 col-lg-7 position-relative">
                 @if(\Illuminate\Support\Facades\Auth::id() === $product->product_author)
                     <div class="position-absolute top-0" style="right: 0;">
                         <a type="button" class="btn btn-outline-primary" href="{{ route('show-product-update', ["id" => $product->id]) }}"> <i class="fa fa-pencil-square"></i> Update Product</a>
                     </div>
                 @endif
                 <div class="detail-box">
                     @if(
                        getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['H'] == 0 &&
                        getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['M'] == 0 ||
                        $product->product_status == 'Sold'
                     )
                        <p class="text-bold bg-success opacity-75 w-25 text-center p-3 radius">
                            Biting Time is Up
                        </p>
                     @else
                         <p class="text-bold bg-success opacity-75 w-25 text-center p-3 radius">
                            {{ getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['H']  }}H
                            {{ getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['M']  }}M
                         </p>
                         Remaining To Bit
                     @endif

                         <div class="heading_container">
                         <h2>
                             {{ $product->product_title }}
                         </h2>
                     </div>
                         <p> {{ $product->product_description }} </p>
                        <div class="d-flex">
                            <p> Seller Name: {{ $product->seller->name }} </p>
                            <p class="mx-4"> Seller Email: {{ $product->seller->email }} </p>
                        </div>
                         <hr>
                         <p>Base Price  ৳{{ $product->product_base_price }}</p>
                    @if(
                         $product->product_status == \App\Enums\ProductStatusEnum::Available()->value
                    )
                        <form  method="POST" action="{{ route('bit-product') }}">
                         @csrf
                         <input type="number" name="bit_price" hidden value="{{($biting_price  ?? $product->product_base_price) + 100 }}" >
                         <input type="number" name="id" hidden value="{{ $product->id }}" >
                         <button type="submit" class="bg-transparent border-0 p-0">
                             @if(
                                (getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['H'] == 0 &&
                                getIntervalSessionForProduct(interval($product->created_at,  date('Y-m-d H:i:s')))['M'] == 0)
                            )
                             @else
                                 <a class="text-black product_bit_button">
                                     Bit for  ৳{{ ($biting_price  ?? $product->product_base_price) + 100  }}
                                 </a>
                             @endif

                         </button>
                        </form>
                         @elseif($product->product_status == \App\Enums\ProductStatusEnum::Sold()->value)
                             <a type="" class="text-black">
                                 Sold for  ৳{{ $product->product_sold_price }}
                             </a>
                            <h3 class="my-2">Auction Winner: {{ $product->buyer->name }}</h3>
                         @else
                             <span class="py-2 px-4" style="border-radius: 45px; background: rgba(138,23,23,0.42);">{{ $product->product_status }}</span>
                         @endif
                 </div>
             </div>

         </div>
         <hr>
         <div class="comment__section my-4 w-50 mx-auto">
             <form method="POST" action="{{ route('product-comment', ['id' => $product->id]) }}">
                 @csrf
                 <div class="form-floating">
                     <textarea name="details" class="form-control bg-transparent text-white" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                     <label for="floatingTextarea">Comments</label>
                 </div>
                 <button type="submit" class="btn btn-primary w-25 my-4">Submit</button>
             </form>
         </div>
         <hr>
         @foreach($product->comments as $key =>$comment)
            <div class="comment__view my-4 w-50 mx-auto">
                <small>{{ $key+1 .'. '. $comment->comment_text }}</small>
                <hr>
            </div>

         @endforeach

     </div>
 </section>




@endsection
