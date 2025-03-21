<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $rose;
    public $roseId;

    public $price;


    public function mount($roseId)
    {
        $this->roseId = $roseId;
        $this->rose = ModelsCart::where('product_id', $roseId)
            ->where('product_id', auth()->id())
            ->first();

            $this->price = Product::where('id', $roseId)
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
                'product_id' => $this->roseId, 
                'status' => 1,
                'total_price'=>$this->price->price
            ]);
            $this->rose = $newFavorite;
        }
    }

}
