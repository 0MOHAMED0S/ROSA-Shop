<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $roseId;
    public $price;

    public function mount($roseId)
    {
        $this->roseId = $roseId;
        $this->cart = ModelsCart::where('product_id', $roseId)
            ->where('user_id', auth()->id()) // Fixed condition
            ->first();

        $this->price = Product::where('id', $roseId)->value('price'); // Fetch only price
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function toggleFavorite()
    {
        $auth = auth()->id();

        if ($this->cart) {
            $this->cart->delete();
            $this->cart = null;
        } else {
            $this->cart = ModelsCart::create([
                'user_id' => $auth,
                'product_id' => $this->roseId,
                'status' => 1,
                'total_price' => $this->price, // Fixed total price
            ]);
        }
    }
}
