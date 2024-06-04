<?php

namespace App\Livewire;

use App\Models\favorites;
use Livewire\Component;

class Favorite extends Component
{
    public $rose;
    public $roseId;

    public function mount($roseId)
    {
        $this->roseId = $roseId;
        $this->rose = favorites::where('rosa_id', $roseId)
            ->where('user_id', auth()->id())
            ->first();
    }


    public function render()
    {
        return view('livewire.favorite');
    }

    public function toggleFavorite()
    {
        $auth = auth()->id();
        if ($this->rose) {
            $this->rose->delete();
            $this->rose = null;
        } else {
            $newFavorite = Favorites::create([
                'user_id' => $auth,
                'rosa_id' => $this->roseId, 
                'status' => 1,
            ]);
            $this->rose = $newFavorite;
        }
    }
}
