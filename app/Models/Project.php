<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'deadline_at', 'status', 'client_id'];

    public const STATUS = [
      'ACTIVE' => 1,
      'PENDING' => 2,
      'FINISHED' => 3,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
