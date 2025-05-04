<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $list = $this->list();
        return view('components.menu',[
            'list'=>$list,
        ]);
    }

    public function list(){
        return[
            [
                'label' => 'Dashboard'
            ],
            [
                'label' => 'Movies'
            ],
            [
                'label' => 'Theaters'
            ],
            [
                'label' => 'Tickets'
            ],
            [
                'label' => 'Users'
            ],
        ];
    }
}
