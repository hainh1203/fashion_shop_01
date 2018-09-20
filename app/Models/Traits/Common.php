<?php

namespace App\Models\Traits;

use App\Models\User;
use Carbon\Carbon;

/**
 * Trait Common
 * @package App\Models\Traits
 */
trait Common
{
    /**
     * ==================== Relationships ===================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUser($query)
    {
        return $query->with('user');
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('common.format_time'));
    }

    /**
     * @param $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('common.format_time'));
    }
}
