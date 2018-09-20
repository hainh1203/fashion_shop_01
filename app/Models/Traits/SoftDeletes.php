<?php

namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes as BaseSoftDeletes;

/**
 * Trait SoftDeletes
 * @package App\Models\Traits
 */
trait SoftDeletes
{
    use BaseSoftDeletes;

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $time (s)
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTimeSoftDelete($query, $time)
    {
        // TODO: Calculates time and returns values in database format
        $dateTime = date('Y-m-d H:i:s', time() - $time);

        return $query->where('deleted_at', '>', $dateTime);
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * @param $value
     * @return string
     */
    public function getDeletedAtAttribute($value)
    {
        return Carbon::parse($value)->format(config('common.format_time'));
    }
}
