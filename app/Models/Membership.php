<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    const FREE = 'free';
    const PREMIUM = 'premium';

    protected $guarded = ['id'];

    public function scopeUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    /**
     * The function returns the membership status based on the plan type.
     * 
     * @return the membership status based on the value of the `` property. If the value is
     * `FREE`, it will return 'Free'. If the value is `PREMIUM`, it will return 'Premium'. If the value
     * is neither `FREE` nor `PREMIUM`, it will return 'Unknown'.
     */
    public function membershipStatus()
    {
        switch ($this->plan_type) {
            case self::FREE:
                return 'Free';
            case self::PREMIUM:
                return 'Premium';
            default:
                return 'Unknown';
        }
    }

}
