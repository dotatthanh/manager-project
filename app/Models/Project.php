<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
    	'type_id',
    	'room_id',
    	'customer_id',
    	'name',
    	'description',
    	'priority',
    	'status',
    	'start_date',
    	'end_date',
    	'progress',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function techStacks()
    {
        return $this->belongsToMany(TechStack::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
