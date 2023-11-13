<?php

namespace App\Http\Livewire\Admin\Chart;

use Livewire\Component;
use App\Models\Chart;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $chart_id;

    public function render()
    {
        $charts = Chart::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.chart.index', ['charts' => $charts]);
    }

    public function deleteChart($chart_id)
    {
        $this->chart_id = $chart_id;
    }

    public function destroyChart()
    {
        $chart = Chart::find($this->chart_id);
        $path = 'uploads/chart/'.$chart->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $chart->delete();
        session()->flash('message', 'Chart Deleted Successfully!');
        $this->dispatchBrowserEvent('close-modal');
    }
}
