<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContactUsSection extends Component
{
    public $data;
    public $footerStates;

    /**
     * Create a new component instance.
     */
    public function __construct($data = null, $footerStates = [])
    {
        $this->data = $data;
        $this->footerStates = $footerStates;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-us-section');
    }
}
