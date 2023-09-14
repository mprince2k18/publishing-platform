<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use App\Models\Membership;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The function returns a BelongsTo relationship for the Membership model.
     * 
     * @return BelongsTo a BelongsTo relationship.
     */
    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    /**
     * The function returns a relationship where a user has many posts.
     * 
     * @return HasMany a HasMany relationship.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * The scopeAdmin function returns a query that filters results based on the 'role' column being
     * 'admin'.
     * 
     * @param query The query parameter is the instance of the query builder that is being used to
     * build the database query. It allows you to chain additional query methods to further refine the
     * query.
     * 
     * @return The query is being returned with a condition that filters the results to only include
     * records where the 'role' column is set to 'admin'.
     */
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * The function "scopeCustomer" returns a query that filters records where the "role" column is set
     * to "user".
     * 
     * @param query The query parameter is the instance of the query builder that is being used to
     * build the database query. It allows you to chain additional query methods to further refine the
     * query.
     * 
     * @return The query is being returned with a condition that filters the results to only include
     * records where the 'role' column is set to 'user'.
     */
    public function scopeCustomer($query)
    {
        return $query->where('role', 'user');
    }
}
