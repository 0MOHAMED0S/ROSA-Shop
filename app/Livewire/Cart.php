<?php

namespace App\Livewire;

use App\Models\cart as ModelsCart;
use App\Models\rosa;
use Livewire\Component;

class Cart extends Component
{
    public $rose;
    public $roseId;

    public $price;


    public function mount($roseId)
    {
        $this->roseId = $roseId;
        $this->rose = ModelsCart::where('rosa_id', $roseId)
            ->where('user_id', auth()->id())
            ->first();

            $this->price = rosa::where('id', $roseId)
            ->first();
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function toggleFavorite()
    {
        $auth = auth()->id();
        if ($this->rose) {
            $this->rose->delete();
            $this->rose = null;
        } else {
            $newFavorite = ModelsCart::create([
                'user_id' => $auth,
                'rosa_id' => $this->roseId, 
                'status' => 1,
                'total_price'=>$this->price->price
            ]);
            $this->rose = $newFavorite;
        }
    }

}
