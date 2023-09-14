<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

/**
 * The function `getPosts()` retrieves the user's posts from the cache or database and returns them in
 * a paginated format.
 * 
 * @return a paginated list of posts belonging to the authenticated user.
 */
function getPosts()
{
    // Define a unique cache key for this query
    $cacheKey = 'user_posts'; // You might want to use a more descriptive key
    
    return Cache::remember($cacheKey, now()->addMinutes(10), function () {
        return Post::UserPost()->simplePaginate(10);
    });
}

/**
 * The admin function returns the first user with the role of "admin".
 * 
 * @return the first user with the role 'admin'.
 */
function admin()
{
    return User::Admin()->first();
}

/**
 * The function membership_types() returns an array of membership types with their names and prices.
 * 
 * @return The function `membership_types()` returns an array of membership types. Each membership type
 * is represented by a key-value pair, where the key is the type of membership ('free' or 'premium')
 * and the value is an array containing the name and price of the membership.
 */
function membership_types()
{
    return [
        'free' => [
            'name' => 'Free',
            'price' => 0,
        ],
        'premium' => [
            'name' => 'Premium',
            'price' => 9.99,
        ]
    ];
}

/**
 * The function "getMembershipType" returns the value associated with a given key in an array of
 * membership types, or null if the key doesn't exist.
 * 
 * @param key The key parameter is the index or key of the membership type that you want to retrieve
 * from the membership types array.
 * 
 * @return the value associated with the given key in the `` array. If the key exists
 * in the array, the corresponding value is returned. If the key does not exist, the function returns
 * `null`.
 */
function getMembershipType($key)
{
    $membershipTypes = membership_types();

    if (isset($membershipTypes[$key])) {
        return $membershipTypes[$key];
    } else {
        return null; // or handle the case when the key doesn't exist
    }
}

/**
 * The function `getuserCurrentMembershipType()` returns the plan type of the current user's
 * membership.
 * 
 * @return the plan type of the current user's membership.
 */
function getuserCurrentMembershipType()
{
    $user = auth()->user();
    return $user->membership->plan_type;
}