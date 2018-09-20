<?php

namespace App\Models;

use App\Models\Traits\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Review
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $product_id
 * @property text $content
 * @property double $rating
 * @property int $user_id
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Review extends Model
{
    use Common, Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'content',
        'rating',
        'user_id',
    ];

    /**
     * ==================== Relationships ===================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class)
            ->withTrashed();
    }

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithProduct($query)
    {
        return $query->with('product');
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * ==================== Other methods  ==================================
     */
}
