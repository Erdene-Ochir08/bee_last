<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormUpdateRequest;
use App\Models\Brand;
use App\Models\Gender;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $products = Product::orderBy('id', 'DESC')->paginate(10);

        return view('admin.product.index', compact('products' ));
    }

    public function create()
    {
        $genders = Gender::all();
        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::where('status', '0')->get();
        return view('admin.product.create', compact('categories', 'brands', 'colors','sizes','genders'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'gender_id' => $validatedData['gender_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'sale_percent' => $validatedData['sale_percent'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'trending' => $request->trending == true ? '1':'0',
            'status' => $request->status == true ? '1':'0',
            'quantity' => null,
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/product/';

            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath,$filename);
                $finalImagePathName = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName
                ]);
            }
        }

        if($request->colors){
            foreach($request->colors as $key => $color){
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
            }
        }

        if($request->sizes){
            foreach($request->sizes as $key => $size) {
                $product->productSizes()->create([
                   'product_id' => $product->id,
                   'size_id' => $size,
                ]);
            }
        }

        $totalQuantity = $product->productColors->sum('quantity');

        $product->update(['quantity' => $totalQuantity]);

        return redirect('admin/product')->with('message', 'Product Added Successfully!');

    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $genders = Gender::all();
        $product = Product::findOrFail($id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id', $product_color)->get();
        $product_size = $product->productSizes->pluck('size_id')->toArray();
        $sizes = Size::whereNotIn('id', $product_size)->get();

        return view('admin.product.edit', compact('categories', 'brands', 'product', 'colors','sizes','genders'));
    }

    public function update(ProductFormUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
            ->products()->where('id', $id)->first();

        if($product)
        {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'gender_id' => $validatedData['gender_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'sale_percent' => $validatedData['sale_percent'],
                'price' => $validatedData['price'],
                'trending' => $request->trending == true ? '1':'0',
                'status' => $request->status == true ? '1':'0',
                'quantity' => $validatedData['quantity'],
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/product/';

                $i = 1;
                foreach($request->file('image') as $imageFile){
                    $extension = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extension;
                    $imageFile->move($uploadPath,$filename);
                    $finalImagePathName = $uploadPath.$filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName
                    ]);
                }
            }

            if($request->colors){
                foreach($request->colors as $key => $color){
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' => $color,
                        'quantity' => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }

            if($request->sizes){
                foreach($request->sizes as $key => $size) {
                    $product->productSizes()->create([
                        'product_id' => $product->id,
                        'size_id' => $size,
                    ]);
                }
            }


            $totalQuantity = $product->productColors->sum('quantity');

            $product->update(['quantity' => $totalQuantity]);


            return redirect('admin/product')->with('message', 'Product Updated Successfully!');
        }
        else
        {
            return redirect('admin/product')->with('message', 'No Such Product Id Found!');
        }
    }

    public function destroyImage($id)
    {
        $productImage = ProductImage::findOrFail($id);
        if(File::exists($productImage->image)){
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted Successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }

        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully!');
    }

    public function brandGet(Request $request)
    {
        $category_id = $request->input('category_id');

        $brands = Brand::where('category_id', $category_id)->get();

        return response()->json($brands);
    }

    public function updateProductColorQty(Request $request, $product_color_id)
    {
        $productColor = ProductColor::findOrFail($product_color_id);

        $productColor->update([
            'quantity' => $request->qty
        ]);

        if ($productColor) {
            $product = $productColor->product;
            $totalQuantity = $product->productColors->sum('quantity');

            $product->update(['quantity' => $totalQuantity]);

//            return response()->json([
//                'message' => 'Product quantity updated successfully',
//                'product' => $product,
//            ]);
        }

        return response()->json(['message' => 'Product Color Quantity Updated!']);
    }


//    public function testColor($id)
//    {
//        $productColor = ProductColor::find($id);
//
//        if ($productColor) {
//            $product = $productColor->product;
//            $totalQuantity = $product->productColors->sum('quantity');
//
//            $product->update(['quantity' => $totalQuantity]);
//
//            return response()->json([
//                'message' => 'Product quantity updated successfully',
//                'product' => $product,
//            ]);
//        } else {
//            return response()->json(['message' => 'ProductColor not found'], 404);
//        }
//    }



    public function deleteProductColor($product_color_id)
    {
        $productColor = ProductColor::findOrFail($product_color_id);
        $productColor->delete();

        return response()->json(['message'=>'Product Color Deleted!']);

    }

    public function deleteProductSize($product_size_id)
    {
        $productSize = ProductSize::findOrFail($product_size_id);
        $productSize->delete();

        return response()->json(['message'=>'Product Size Deleted!']);
    }

}
