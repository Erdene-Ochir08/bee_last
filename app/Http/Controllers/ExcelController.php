<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate(['products' => ['required']]);

        Excel::import(new ProductImport, $request->file('products'));

        return redirect('/admin/product')->with('message', 'Product Import Successfully');
    }
}
