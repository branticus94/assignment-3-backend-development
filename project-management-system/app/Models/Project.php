<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Project Model
 *
 * Represents a project entity in the application.
 * A project belongs to a user and can be filtered using
 * the "owned" query scope.
 */
class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * Only the fields listed here can be set via mass assignment
     * (e.g., Project::create([...])).
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'short_description',
        'phase',
        'user_id'
    ];

    /**
     * Attribute type casting.
     *
     * Ensures that 'start_date' and 'end_date' are automatically
     * converted to date instances when accessed.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date'
    ];

    /**
     * Relationship: Get the user that owns the project.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Filter projects to only those owned by a specific user.
     *
     * This allows for queries like:
     * Project::owned($userId)->get();
     */
    public function scopeOwned($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
