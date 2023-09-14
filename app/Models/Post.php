<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * The function returns a BelongsTo relationship with the User model.
     * 
     * @return BelongsTo a BelongsTo relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUserPost($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeNotPublished($query)
    {
        return $query->where('is_published', false);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function scopePublishedAt($query)
    {
        return $query->where('published_at', '>=', now());
    }

    // get the post status: published, draft, scheduled
    public function getStatusAttribute()
    {
        if ($this->published_at === null) {
            return $this->is_published ? 'Published' : 'Draft';
        } elseif ($this->published_at > now()) {
            return 'Scheduled at ' . Carbon::createFromFormat('Y-m-d H:i:s', $this->published_at)->format('M d, Y');
        } else {
            return 'Draft';
        }
    }
}