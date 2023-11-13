<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Chart;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ChartFormRequest;


class ChartController extends Controller
{
    public function create()
{
    return view('admin.chart.create');
}
public function store(ChartFormRequest $request)
{
    // Validate input
    $validatedData = $request->validated();
    $validatedData = $request->validated();
        $chart = new Chart();
        $chart->title = $validatedData['title'];
        $chart->description = $validatedData['description'];
        $uploadPath = 'uploads/chart/';
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/chart/', $filename);
            $chart->image = $uploadPath.$filename;
        }
        $chart->save();
        return redirect('admin/charts/create')->with('success', 'Chart Added Successfully!');
}

public function index()
{
    $charts = Chart::all();

    return view('admin.chart.index', compact('charts'));
}
}
