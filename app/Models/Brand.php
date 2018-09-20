<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Common;
use App\Models\Traits\SoftDeletes;

/**
 * Class Brand
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $thumbnail
 * @property string $status
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Brand extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers, Common;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'thumbnail',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
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

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * ==================== Other methods  ==================================
     */
}
