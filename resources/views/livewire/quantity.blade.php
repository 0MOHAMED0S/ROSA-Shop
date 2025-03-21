<td>
    <input min="1" class="quantity-input" type="number" onchange="updateTotal(this)" value="{{$cart->quantity}}">
    <br><br>
    <button type="button" class="quantity-btn" wire:click="decrementQuantity" onclick="decrementQuantity(this)">-</button>
    <button type="button" class="quantity-btn" wire:click="incrementQuantity" onclick="incrementQuantity(this)">+</button>
</td>
