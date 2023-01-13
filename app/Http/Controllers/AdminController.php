<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Category;
use App\Models\User;
// use App\Models\Product;
// use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\MyFirstNotification;

class AdminController extends Controller
{
    //

    public function view_catagory()
    {
        $data=Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_catagory(Request $request)
    {
        $data=new Category;

        $data->catagory_name=$request->catagory;

        $data->save();

        return redirect()->back()->with('message','catagory added successfully');
    }

    public function delete_catagory($id)
    {
        $data=Category::find($id);
        $data->delete();

        return redirect()->back();

    }



}
