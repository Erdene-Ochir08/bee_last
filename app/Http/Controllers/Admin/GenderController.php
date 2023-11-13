<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenderFormRequest;
use App\Models\Gender;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;


class GenderController extends Controller
{

    public function index()
    {
        Paginator::useBootstrapFive();
        $genders = Gender::orderBy('id', 'DESC')->paginate(10);
        return view('admin.gender.index', compact('genders'));
    }

    public function create()
    {
        return view('admin.gender.create');
    }

    public function store(GenderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/gender/',$filename);
            $validatedData['image'] = 'uploads/gender/'.$filename;
        }

        Gender::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'image' => $validatedData['image'],
        ]);

        return redirect('admin/gender')->with('message', 'Gender Added Successfully!');
    }

    public function edit($id)
    {
        $gender =  Gender::findOrFail($id);
        return view('admin.gender.edit', compact('gender'));
    }

    public function update(GenderFormRequest $request, $id)
    {
        $validatedData = $request->validated();

        $gender = Gender::findOrFail($id);

        if($request->hasFile('image')){

            $destination = $gender->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/gender/',$filename);
            $validatedData['image'] = 'uploads/gender/'.$filename;
        }

        Gender::where('id', $gender->id)->update([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'image' => $validatedData['image'] ?? $gender->image,
        ]);

        return redirect('admin/gender')->with('message', 'Gender Updated Successfully!');
    }

    public function destroy($id)
    {
        $gender = Gender::findOrFail($id);
        $gender->delete();

        return redirect('admin/gender')->with('message', 'Gender deleted successfully');
    }
}
