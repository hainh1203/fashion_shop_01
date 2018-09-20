<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Comment
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $parent_id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property text $body
 * @property int $user_id
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Comment extends Model
{
    use Common, Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'commentable_id',
        'commentable_type',
        'body',
        'user_id',
    ];

    /**
     * ==================== Relationships ===================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo()
            ->withTrashed();
    }

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return array|\Illuminate\Support\Collection
     */
    public function scopeToTree($query)
    {
        return Helper::toTree($query->get());
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * ==================== Other methods  ==================================
     */
}
