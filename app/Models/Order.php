<?php

namespace App\Models;

use App\Models\Traits\Common;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Order
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone
 * @property text $note
 * @property string $status
 * @property string $payment_method
 * @property int $user_id
 * @property \DateTime $deleted_at
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class Order extends Model
{
    use SoftDeletes, Common, Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'note',
        'status',
        'payment_method',
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
     * @return mixed
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('price', 'qty')
            ->withTrashed();
    }

    /**
     * ==================== Local scopes  ===================================
     */

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithProducts($query)
    {
        return $query->with('products');
    }

    /**
     * ==================== Customize set, get and virtual fields  ==========
     */

    /**
     * @return float|int
     */
    public function getTotalAttribute()
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->pivot->qty * $product->pivot->price;
        }

        return $total;
    }

    /**
     * ==================== Other methods  ==================================
     */
}
