<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function edit_banner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.index', compact('banner'));
    }

    public function banner_update(Request $request,$id)
    {
        $banner = Banner::findOrFail($id);

        $validatedData = $request->validate([
           'image' => 'nullable|image'
        ]);

        if($request->hasFile('image')){
            $destination = $banner->image;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/banner/',$filename);
            $validatedData['image'] = 'uploads/banner/'.$filename;
        }

        Banner::where('id', '6a847aa8-b157-4bb7-81aa-b8d7e58d0382')->update([
            'image' => $validatedData['image'] ?? $banner->image,
        ]);

        return redirect('admin/dashboard')->with('message', 'Banner updated successfully');
    }

}
