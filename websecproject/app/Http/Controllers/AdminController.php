<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /*---------------------------------------------------
    | CATEGORY MANAGEMENT
    ---------------------------------------------------*/
    public function ViewCategory()
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $categories = Category::all();
            return view('admin.category', compact('categories'));
        }


        return redirect('login');
    }

    public function AddCategory(Request $request)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $data = new Category();
            $data->category_name = $request->category;
            $data->save();

            return redirect()->back()->with('message', 'Category Added Successfully');
        }

        return redirect('login');
    }

    public function DeleteCategory($id)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $category = Category::find($id);
            $category->delete();

            return redirect()->back();
        }

        return redirect('login');
    }

    /*---------------------------------------------------
    | PRODUCT MANAGEMENT
    ---------------------------------------------------*/
    public function AddProduct(Request $request)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {

            $product = new Product();
            $product->title = $request->title;
            $product->category = $request->category;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->screen_size = $request->screen_size;
            $product->screen_resolution = $request->screen_resolution;
            $product->screen_refresh_rate = $request->screen_refresh_rate;
            $product->device_weight = $request->device_weight;
            $product->graphics_type = $request->graphics_type;
            $product->graphics_card_memory = $request->graphics_card_memory;
            $product->ssd_capacity = $request->ssd_capacity;
            $product->operating_system = $request->operating_system;
            $product->processor = $request->processor;
            $product->processor_generation = $request->processor_generation;
            $product->processor_type = $request->processor_type;
            $product->processor_speed = $request->processor_speed;
            $product->ram = $request->ram;
            $product->keyboard = $request->keyboard;
            $product->color = $request->color;

            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move('products_images', $imageName);
            $product->image = $imageName;

            $product->save();

            Alert::success('Product Added Successfully!', 'You have added a new product');
            return redirect()->route('admin.show_product');
        }

        return redirect('login');
    }

    public function ViewProduct()
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $categories = Category::all();
            return view('admin.add_product', compact('categories'));
        }

        return redirect('login');
    }

    public function ShowProduct()
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $products = Product::orderBy('id', 'desc')->get();
            return view('admin.show_product', compact('products'));
        }

        return redirect('login');
    }

    public function DeleteProduct($id)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            Product::find($id)->delete();
            return redirect()->back()->with('message', 'Product Deleted Successfully');
        }

        return redirect('login');
    }

    public function EditProduct($id)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $product = Product::find($id);
            $categories = Category::all();
            return view('admin.edit_product', compact('product', 'categories'));
        }

        return redirect('login');
    }

    public function UpdateProduct(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {

            $product = Product::find($id);

            $product->title = $request->title;
            $product->category = $request->category;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->screen_size = $request->screen_size;
            $product->screen_resolution = $request->screen_resolution;
            $product->screen_refresh_rate = $request->screen_refresh_rate;
            $product->device_weight = $request->device_weight;
            $product->graphics_type = $request->graphics_type;
            $product->graphics_card_memory = $request->graphics_card_memory;
            $product->ssd_capacity = $request->ssd_capacity;
            $product->operating_system = $request->operating_system;
            $product->processor = $request->processor;
            $product->processor_generation = $request->processor_generation;
            $product->processor_type = $request->processor_type;
            $product->processor_speed = $request->processor_speed;
            $product->ram = $request->ram;
            $product->keyboard = $request->keyboard;
            $product->color = $request->color;

            if ($request->hasFile('image')) {
                @unlink(public_path('products_images/'.$product->image));
                $image = $request->image;
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move('products_images', $imageName);
                $product->image = $imageName;
            }

            $product->save();

            Alert::success('Successfully Updated', 'Product Updated!');
            return redirect()->route('admin.show_product');
        }

        return redirect('login');
    }

    /*---------------------------------------------------
    | ORDER MANAGEMENT
    ---------------------------------------------------*/
    public function UserOrders()
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            $orders = Order::where('delivery_status', '!=', 'passive_order')->get();
            return view('admin.orders', compact('orders'));
        }

        return redirect('login');
    }

    public function UpdateOrder($user_id, $order_id, $delivery_status)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {

            $order = Order::where('user_id', $user_id)->where('id', $order_id)->first();

            if ($order) {
                if ($delivery_status == 'cancel_order') {
                    $product = Product::find($order->product_id);
                    if ($product) {
                        $product->quantity += $order->quantity;
                        $product->save();
                        $order->delete();
                        return redirect()->back();
                    }
                }

                $order->delivery_status = $delivery_status;
                $order->save();
            }

            return redirect()->back();
        }

        return redirect('login');
    }

    public function PrintBill($order_id)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {

            $order = Order::find($order_id);

            if ($order) {
                $pdf = PDF::loadView('admin.user_bill', compact('order'));
                return $pdf->download('order_bill_'.$order->id.'.pdf');
            }

            return redirect()->back();
        }

        return redirect('login');
    }

    /*---------------------------------------------------
    | DASHBOARD
    ---------------------------------------------------*/
    public function Dashboard()
    {
        $total_users = User::where('usertype', 0)->count();
        $total_product = Product::count();
        $total_orders = Order::where('delivery_status', 'processing')
                             ->orWhere('delivery_status', 'on_the_way')
                             ->count();
        $delivered_orders = Order::where('delivery_status', 'delivered')->count();
        $processing_orders = Order::where('delivery_status','processing')->count();
        $revenue = Order::where('delivery_status','delivered')->sum('price');
        $sold_products = Order::where('delivery_status','delivered')->sum('quantity');

        return view('admin.dashboard', compact(
            'total_users',
            'total_product',
            'total_orders',
            'delivered_orders',
            'processing_orders',
            'revenue',
            'sold_products'
        ));
    }
}
