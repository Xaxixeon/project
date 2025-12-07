<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shipping;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'customer_id',
        'user_id',
        'product_type',
        'size',
        'material',
        'quantity',
        'finishing',
        'need_design',
        'deadline',
        'notes',
        'order_status',
        'created_by',
        'subtotal',
        'shipping',
        'discount',
        'total',
        'status',
        'meta',
        'width_cm',
        'height_cm',
        'area_m2',
        'printing_material_id',
        'printing_finishing_id',
        'total_price',
        'priority',
        'due_at',
        'started_at',
        'completed_at',
        'material_cost',
        'finishing_cost',
        'other_cost',
        'total_cost',
        'profit',
    ];
    protected $casts = [
        'meta' => 'array',
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'due_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'deadline' => 'date',
        'need_design' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function logs()
    {
        return $this->hasMany(OrderLog::class)->latest();
    }

    public function files()
    {
        return $this->hasMany(OrderFile::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function operations()
    {
        return $this->hasMany(OrderOperation::class);
    }

    public function qcChecks()
    {
        return $this->hasMany(OrderQcCheck::class);
    }

    public function chats()
    {
        return $this->hasMany(OrderChat::class);
    }

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class)->latest();
    }
    /**
     * Get the shipping records associated with the order.
     *
     * An order can have multiple shipping entries (e.g. partial shipments).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
