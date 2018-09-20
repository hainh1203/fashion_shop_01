<?php

namespace App\Models;

use App\Models\Traits\Common;
use Illuminate\Notifications\DatabaseNotification;

/**
 * Class Notification
 * @package App\Models
 */
class Notification extends DatabaseNotification
{
    use Common;

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function scopeCountUnread($query)
    {
        return $query->whereNull('read_at')->count();
    }
}
