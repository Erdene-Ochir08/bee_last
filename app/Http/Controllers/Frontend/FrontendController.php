<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Brand;
use App\Models\Chart;
class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $saleProducts = Product::where('sale_percent', '>' , '0')->take(15)->get();
        $latestProducts = Product::latest()->take(15)->get();
        $allProducts = Product::all();
        $brands = Brand::where('status','0')->get();
        $banner = Banner::findOrFail('6a847aa8-b157-4bb7-81aa-b8d7e58d0382');
        $genders = Gender::all();

        $categories = Category::where('status', '0')->get();
        return view('frontend.index', compact('sliders', 'trendingProducts',
            'categories','saleProducts','latestProducts','allProducts', 'banner','brands','genders'));
    }

    public function categories()
    {
        $categories = Category::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function genderProducts($gender_id)
    {
        $genderProducts = Product::where('gender_id', $gender_id)->get();
        return view('frontend.collections.gender.index', compact('genderProducts'));
    }

    public function saleProducts()
    {
        $saleProducts = Product::where('sale_percent', '>' , '0')->get();
        return view('frontend.collections.sale.index', compact('saleProducts'));
    }
    public function latestProducts()
    {
        $latestProducts = Product::latest()->get();
        return view('frontend.collections.latest.index', compact('latestProducts'));
    }
    public function chart()
    {
        $charts = Chart::latest()->get();
        return view('frontend.collections.chart.index', compact('charts'));
    }
    public function trendingProducts()
    {
        $trendingProducts = Product::where('trending', '1')->latest()->get();
        return view('frontend.collections.trend.index', compact('trendingProducts'));
    }
    public function products($category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();

        if ($category) {
            $products = $category->products()->get();
            return view('frontend.collections.products.index', compact('category','products'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();



        if ($category) {

            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($product) {

                return view('frontend.collections.products.view', compact('category', 'product'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function viewLatestProduct()
    {
        $latestProducts = Product::latest()->take(5)->get();
//        dd($latestProducts);
        return view('livewire.frontend.product.view', compact('latestProducts'));
    }

    public function thankyou()
    {
        return view('frontend.thank-you');
    }

    public function searchProduct(Request $request)
    {
        if($request->search) {
            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.pages.search',compact('searchProducts'));
        }
        else{
            return redirect()->back()->with('message','Илэрч олдсонгүй');
        }
    }


}
