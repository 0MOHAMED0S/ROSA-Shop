<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $cart;
    public $productId;
    public $price;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->cart = CartModel::where('product_id', $productId)
            ->where('user_id', Auth::id())
            ->first();

        $this->price = Product::where('id', $productId)->value('price');
    }

    public function render()
    {
        return view('livewire.cart');
    }

    public function toggleCartItem()
    {
        if (!Auth::check()) {
            return;
        }

        if ($this->cart) {
            $this->cart->delete();
            $this->cart = null;
        } else {
            $this->cart = CartModel::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $this->productId],
                ['status' => 1, 'total_price' => $this->price]
            );
        }
    }
}
