<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pageheader extends Component
{
    public $title;
    public $head;
    public $headUrl;
    public $body;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $head, $headUrl, $body)
    {
        $this->title = $title;
        $this->head = $head;
        $this->headUrl = $headUrl;
        $this->body = $body;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pageheader');
    }
}
