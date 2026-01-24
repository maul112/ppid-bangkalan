<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PublikLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Ini mengarahkan ke file resources/views/layouts/publik.blade.php
        return view('layouts.publik');
    }
}