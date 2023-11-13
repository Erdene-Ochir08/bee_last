<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id, $category_id, $image, $uploadPath;

    public function render()
    {
        $categories = Category::where('status','0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'slug' => 'required|string',
            'image' => 'required|image',
            'status' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->image = NULL;
        $this->category_id = NULL;
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        $uploadPath = 'uploads/brands/';

        if ($this->image) {
            $file = $this->image;
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->storeAs($uploadPath, $filename, 'public');
        }

        $brandData = [
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
            'image' => $uploadPath . $filename,
        ];



        Brand::create($brandData);

        session()->flash('message', 'Brand амжилттай нэмэгдлээ');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;

    }

    public function updateBrand()
    {
        $validatedData = $this->validate();

        $brandData = [
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
        ];

        if ($this->image) {
            $imagePath = $this->image->store('brands', 'public');
            $brandData['image'] = $imagePath;
        }

        Brand::find($this->brand_id)->update($brandData);

        session()->flash('message', 'Brand амжилттай шинэчлэгдлээ');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand амжилттай устлаа');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

}
