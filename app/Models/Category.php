<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Models\Traits\Common;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SoftDeletes;

/**
 * Class Category
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $slug
 * @property string $status
 * @property string $type
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Category extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, Common;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'status',
        'type',
        'user_id',
        'sort_order',
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'categoryable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categoryable');
    }

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
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithProductsPublished($query)
    {
        return $query->with([
            'products' => function ($query) {
                return $query->published();
            },
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTypePost($query)
    {
        return $query->where('type', 'post');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfTypeProduct($query)
    {
        return $query->where('type', 'product');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return array
     */
    public function scopeArrayFormSelect($query)
    {
        return Helper::arrayFormSelect($query->get());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return array
     */
    public function scopeArrayToTree($query)
    {
        return Helper::arrayToTree($query->get());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortByOrder($query)
    {
        return $query->orderBy('sort_order');
    }

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
