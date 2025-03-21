<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'path',
        'section_id'
    ];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

}
