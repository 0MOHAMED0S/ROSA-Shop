<?php

namespace App\Livewire;

use App\Models\Favorite as Fav;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Favorite extends Component
{
    public $favorite;
    public $productId;

    public function mount($productId)
{
    $this->productId = $productId;
    $userId = Auth::id();

    if ($userId) {
        $this->favorite = Fav::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();
    } else {
        $this->favorite = null;
    }
}
    public function render()
    {
        return view('livewire.favorite');
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            return;
        }

        if ($this->favorite) {
            $this->favorite->delete();
            $this->favorite = null;
        } else {
            $this->favorite = Fav::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $this->productId],
                ['status' => 1]
            );
        }
    }
}
