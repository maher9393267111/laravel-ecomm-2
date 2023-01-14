<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use RealRashid\SweetAlert\Facades\Alert;

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




}
