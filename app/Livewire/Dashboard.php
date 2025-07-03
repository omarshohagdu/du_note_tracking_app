<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
class Dashboard extends Component
{
    public function render()
    {
        $totalPatient   =   0;
        $todayPatient   =   0;
        return view('dashboard',['totalPatient'=>$totalPatient,'todayPatient'=>$todayPatient]);
    }
}
