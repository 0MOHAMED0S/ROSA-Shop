<?php

namespace App\Livewire;

use App\Models\cart;
use Livewire\Component;

class Quantity extends Component
{
    public $cart;
    public $cartId;

    public function mount($cartId)
    {
        $this->cartId = $cartId;
        $this->cart = cart::find($cartId);
    }

    public function incrementQuantity()
    {
        $this->cart->increment('quantity');  // Use increment method
        $this->cart->total_price= ($this->cart->Rosa->price) * ($this->cart->quantity);
        $this->cart->save();
    }

    public function decrementQuantity()
    {
        if ($this->cart->quantity > 0) {
            $this->cart->decrement('quantity');  // Use decrement method
            $this->cart->total_price= ($this->cart->Rosa->price) * ($this->cart->quantity);
            $this->cart->save();
        }
    }
    public function render()
    {
        return view('livewire.quantity');
    }
}
