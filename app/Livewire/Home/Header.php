<?php

namespace App\Livewire\Home;

use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function render()
    {
        $carTypes = Car::select('type')->distinct()->get()->pluck('type');

        return view('livewire.home.header', [
            'carTypes' => $carTypes,
            'currentType' => request()->query('type'),
        ]);
    }
}
