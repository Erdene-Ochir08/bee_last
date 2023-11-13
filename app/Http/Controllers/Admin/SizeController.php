<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
class SizeController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $sizes = Size::orderBy('id', 'DESC')->paginate(10);
        return view('admin.size.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.size.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:sizes',
        ]);

        Size::create([
            'name' => $request->input('name'),
        ]);

        return redirect('admin/sizes')->with('message', 'Size created successfully');
    }

    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.size.edit', compact('size'));
    }

    public function update($id, Request $request)
    {
        $size = Size::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|unique:sizes',
        ]);

        $size->update($validatedData);

        return redirect('admin/sizes')->with('message', 'Size updated successfully');
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        return redirect('admin/sizes')->with('message', 'Size deleted successfully');
    }
}
