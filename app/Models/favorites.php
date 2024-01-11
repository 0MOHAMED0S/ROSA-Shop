<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class favorites extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rosa_id',
        'status',
    ];

    public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
        public function Rosa(): BelongsTo
        {
            return $this->belongsTo(rosa::class);
        }
}
