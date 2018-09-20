<?php

namespace App\Models;

use App\Models\Traits\Common;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SoftDeletes;

/**
 * Class Tag
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $status
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Tag extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, Common;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * ==================== Relationships ===================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
            ->withTimestamps();
    }

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'like', "%{$q}%");
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithPostsPublished($query)
    {
        return $query->with([
            'posts' => function ($query) {
                return $query->published();
            },
        ]);
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * ==================== Other methods  ==================================
     */
}
