<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
   public $title;
   public $details;
   public $image;

    /**
     * Create the component instance.
     *
     * @param string $title
     * @param string $details
     * @param string $image
     */
    public function __construct(string $title, string $details, string $image)
    {
        $this->title = $title;
        $this->details = $details;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.banner');
    }
}
