<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Squire\Models\Country;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class); 
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function countryName(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country');
    }

    public function scopeAccount(Builder $builder):  Builder
    {
        return $builder->whereBelongsTo(
            auth()->user(),
            'account'
        );
    }
}
