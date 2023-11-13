<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{

    public function edit_setting($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.shop_information.index', compact('client'));
    }

    public function setting_update(Request $request,$id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'shop_name' => 'required|string',
            'shop_address' => 'required|string',
            'shop_logo' => 'nullable',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'working_hour' => 'required',
            'account_number' => 'required|numeric',
            'account_name' => 'required',
            'google_map_link' => 'nullable',
            'facebook_link' => 'nullable',
            'instagram_link' => 'nullable',
            'youtube_link' => 'nullable',
            'twitter_link' => 'nullable'
        ]);

        if($request->hasFile('shop_logo')){
            $destination = $client->shop_logo;
            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('shop_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/shopdata/',$filename);
            $validatedData['shop_logo'] = 'uploads/shopdata/'.$filename;
        }

        Client::where('id', 'd03a7f43-f1e3-47b0-8a61-21e79df08c7f')->update([
            'shop_name' => $validatedData['shop_name'],
            'shop_address' => $validatedData['shop_address'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'working_hour' => $validatedData['working_hour'],
            'account_number' => $validatedData['account_number'],
            'account_name' => $validatedData['account_name'],
            'shop_logo' => $validatedData['shop_logo'] ?? $client->shop_logo,

            'google_map_link' => $validatedData['google_map_link'],
            'facebook_link' => $validatedData['facebook_link'],
            'instagram_link' => $validatedData['instagram_link'],
            'youtube_link' => $validatedData['youtube_link'],
        ]);

        return redirect('admin/dashboard')->with('message', 'Site information updated successfully');
    }



}
