<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ends_at',
        'status',
        'tech_stack',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'ends_at' => 'datetime',
            'status' => ProjectStatus::class,
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', ProjectStatus::OPEN->value);
    }

    public function scopeClosed(Builder $query): Builder
    {
        return $query->where('status', ProjectStatus::CLOSED->value);
    }

    public function isOpen(): bool
    {
        return $this->status === ProjectStatus::OPEN;
    }

    public function isClosed(): bool
    {
        return $this->status === ProjectStatus::CLOSED;
    }

    public function hasProposals(): bool
    {
        return $this->proposals()->exists();
    }

    public function getProposalsCountAttribute(): int
    {
        return $this->proposals()->count();
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'project_categories');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return $this->ratings()->avg('rating') ?? 0.0;
    }
}
