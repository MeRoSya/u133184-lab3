<?php

namespace App\Domain\Orders\Models;

use App\Domain\Addresses\Models\Address;
use App\Domain\Customers\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'customer_id',
        'creation_time',
        'deliver_before',
        'cost',
        'payed',
        'delivered'
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
