<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class HomeController extends Controller
{
    //

    public function index(){

      $product=product::paginate(3);
        return  view('home.userpage',compact('product'));

    }




    public function redirect()
    {
                $usertype=Auth::user()->usertype;

              //  dd($usertype);

        if ($usertype=='1')

        {
          return  view('admin.home');
        }

        else {
         return   view('dashboard');

        }
    }


    public function prouduct_details($id)
    {
        $product=product::find($id);
        return view('home.product_details',compact('product'));
    }



    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();

            $userid=$user->id;

            $product=product::find($id);

            $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if ($product_exist_id)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;

                if ($product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $request->quantity;

                }

                else
                {
                    $cart->price=$product->price * $request->quantity;

                }

                $cart->save();
               // Alert::success('Product Added Successfully','We Have Added Product to The Cart');
                return redirect()->back();

            }
            else
            {

            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;

            $cart->image=$product->image;
            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;

            $cart->save();
            return redirect()->back();

            }

        }



    else
    {
        return redirect('login');
    }
}




public function Show_cart()
{
    if(Auth::id())
    {
        $id=Auth::user()->id;
        $cart=cart::where('user_id','=',$id)->get();
    //    dd($cart);
        return view('home.Show_cart',compact('cart'));
    }
    else
    {
        return redirect('login');
    }

}



public function remove_cart($id)
{
    $cart=cart::find($id);
    $cart->delete();

    return redirect()->back()->with('message','Remove Product Successfully');
}


public function cash_order()
{
    $user=Auth::user();
    $user_id=$user->id;

    $data=cart::where('user_id','=',$user_id)->get();

    foreach ($data as $data)
    {
        $order=new order;
        $order->name=$data->name;
        $order->email=$data->email;
        $order->phone=$data->phone;
        $order->address=$data->address;
        $order->user_id=$data->user_id;
        $order->product_title=$data->product_title;
        $order->price=$data->price;
        $order->quantity=$data->quantity;
        $order->image=$data->image;
        $order->product_id=$data->product_id;

        $order->payment_status='cash on delivery';
        $order->delivery_status='processing';

        $order->save();

        $cart_id=$data->id;
        $cart=cart::find($cart_id);

        $cart->delete();
    }

    return redirect()->back()->with('message','We Have Received Your Order. We Will Connect With You Soon ....');
}





}
