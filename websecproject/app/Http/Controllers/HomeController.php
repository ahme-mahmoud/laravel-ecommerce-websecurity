<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        if (Auth::check()) {
            $cartData = Cart::where('user_id', Auth::id())->get();
            return view('user.index', compact('products','categories','cartData'));
        }

        return view('user.index', compact('products','categories'));
    }


public function ShopPage()
{
    $categories = Category::all();
    $products = Product::all();

    if (Auth::check()) {
        $cartData = Cart::where('user_id', Auth::id())->get();

        return view('user.shop', compact(
            'products',
            'categories',
            'cartData'
        ));
    }

    return view('user.shop', compact(
        'products',
        'categories'
    ));
}

public function ContactPage()
{
    if (Auth::check()) {
        $cartData = Cart::where('user_id', Auth::id())->get();

        return view('user.contact', compact('cartData'));
    }

    return view('user.contact');
}








    public function Home()
    {
        if (Auth::user()->usertype == 1) {
            $total_users = User::where('usertype',0)->count();
            $products = Product::all();

            $total_product = $products->sum('quantity');
            $orders = Order::all();

            $sold_products = $orders->sum('quantity');
            $revenue = $orders->where('payment_status','paid')->sum('price');

            return view('admin.home', compact(
                'total_users','total_product','sold_products','revenue'
            ));
        }

        return $this->index();
    }

    public function UserAccount()
    {
        if (!Auth::check()) return redirect('login');

        $cartData = Cart::where('user_id',Auth::id())->get();
        return view('user.my-account', [
            'user'=>Auth::user(),
            'cartData'=>$cartData
        ]);
    }


    public function UserOrders(){
    if(!Auth::check()) return redirect('login');

    $uid = Auth::id();

    return view('user.orders',[
        'cartData' => Cart::where('user_id',$uid)->get(),
        'orderData' => Order::where('user_id',$uid)
                            ->where('delivery_status','<>','passive_order')
                            ->get(),
        'past_orders' => Order::where('user_id',$uid)
                            ->where('delivery_status','passive_order')
                            ->get()
    ]);
}







    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('laravel_session'));
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));

        return redirect('/');
    }

    public function ProductDetails($id)
    {
        $product = Product::findOrFail($id);

        if (Auth::check()) {
            $cartData = Cart::where('user_id',Auth::id())->get();
            return view('user.product_details', compact('product','cartData'));
        }

        return view('user.product_details', compact('product'));
    }

    public function AddToCart(Request $request, $id)
    {
        if (!Auth::check()) return redirect('login');

        $product = Product::findOrFail($id);

        if ($request->quantity > $product->quantity) {
            Alert::warning('Failed','Quantity exceeds stock');
            return back();
        }

        $price = $product->price;
        if ($product->discount_price > 0) {
            $price -= ($price * $product->discount_price / 100);
        }

        $cart = Cart::firstOrCreate(
            ['user_id'=>Auth::id(),'product_id'=>$id],
            [
                'name'=>Auth::user()->name,
                'email'=>Auth::user()->email,
                'product_title'=>$product->title,
                'image'=>$product->image,
                'quantity'=>0,
                'price'=>0
            ]
        );

        $cart->quantity += $request->quantity;
        $cart->price += $price * $request->quantity;
        $cart->save();

        $product->decrement('quantity', $request->quantity);

        Alert::success('Success','Added to cart');
        return back();
    }
}
