<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'date',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];    

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    
}
