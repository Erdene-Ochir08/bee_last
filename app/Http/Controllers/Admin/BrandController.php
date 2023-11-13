<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image',
            'status' => 'nullable'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/brands/',$filename);
            $validatedData['image'] = 'uploads/brands/'.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Brand::create([
            'name' =>  $validatedData['name'],
            'slug' =>  $validatedData['name'],
            'status' =>  $validatedData['status'],
            'image' => $validatedData['image'],
            'category_id' =>  $validatedData['category_id']
        ]);

        return redirect('admin/brands')->with('message', 'Brand Added Successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $categories = Category::all();
        return view('admin.brand.edit', compact('brand','categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'image',
            'status' => 'nullable'
        ]);

        $brand = Brand::findOrFail($id);

        if($request->hasFile('image')){

            $destination = $brand->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/brands/',$filename);
            $validatedData['image'] = 'uploads/brands/'.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Brand::where('id', $brand->id)->update([
            'name' =>  $validatedData['name'],
            'slug' =>  $validatedData['name'],
            'status' =>  $validatedData['status'],
            'image' => $validatedData['image'] ?? $brand->image,
            'category_id' =>  $validatedData['category_id']
        ]);

        return redirect('admin/brands')->with('message', 'Brand Updated Successfully!');
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);

        if($brand->count() > 0){
            $destination = $brand->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $brand->delete();
            return redirect('admin/brands')->with('message', 'Brand Deleted Successfully!');
        }
        return redirect('admin/brands')->with('message', 'Something went wrong!');
    }
}
