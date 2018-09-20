<?php

namespace App\Models;

use App\Models\Traits\Common;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SoftDeletes;

/**
 * Class Product
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $price
 * @property int $sale
 * @property string $thumbnail
 * @property text $excerpt
 * @property text $description
 * @property string $status
 * @property boolean $feature
 * @property int $brand_id
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Product extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, Common;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'sale',
        'thumbnail',
        'excerpt',
        'description',
        'status',
        'feature',
        'brand_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }

    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->withPivot('price', 'qty')
            ->withTrashed();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get all of the product's comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
    public function scopeWithBrand($query)
    {
        return $query->with('brand');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfFeature($query)
    {
        return $query->where('feature', 1);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfSale($query)
    {
        return $query->where('sale', '>', 0);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $q
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'like', "%{$q}%")
            ->orWhere('excerpt', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%");
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * @return float|int
     */
    public function getRealPriceAttribute()
    {
        return $this->sale
            ? ($this->price * $this->sale) / 100
            : $this->price;
    }

    /**
     * @return mixed
     */
    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }

    /**
     * ==================== Other methods  ==================================
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
}
