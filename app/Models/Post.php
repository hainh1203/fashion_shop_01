<?php

namespace App\Models;

use App\Models\Traits\Common;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SoftDeletes;

/**
 * Class Post
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $thumbnail
 * @property text $excerpt
 * @property text $description
 * @property string $status
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Post extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, Common;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'thumbnail',
        'excerpt',
        'description',
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
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get all of the post's comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
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
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTagsPublished($query)
    {
        return $query->with([
            'tags' => function ($query) {
                return $query->published();
            },
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCommentsWithUser($query)
    {
        return $query->with([
            'comments' => function ($query) {
                return $query->withUser();
            },
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('title', 'like', "%{$q}%")
            ->orWhere('excerpt', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%");
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
                'source' => 'title',
            ],
        ];
    }

    /**
     * ==================== Other methods  ==================================
     */
}
