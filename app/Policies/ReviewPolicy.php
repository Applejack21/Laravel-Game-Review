<?php

namespace App\Policies;

use App\User;
use App\Reviews;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReviewPolicy
{
    use HandlesAuthorization;
    
    public function admin(User $user)
    {
        if($user->role==1){
            return true;
        }
        return false;
    }
    
    public function nonadmin(User $user)
    {
        if($user->role==2){
            return true;
        }
        return false;
    }
    
    public function both(User $user)
    {
        if($user->role>=0){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can view the reviews.
     *
     * @param  \App\User  $user
     * @param  \App\Reviews  $reviews
     * @return mixed
     */
    public function view(User $user, Reviews $reviews)
    {
        //
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the reviews.
     *
     * @param  \App\User  $user
     * @param  \App\Reviews  $reviews
     * @return mixed
     */
    public function update(User $user, Reviews $reviews)
    {
        //
    }

    /**
     * Determine whether the user can delete the reviews.
     *
     * @param  \App\User  $user
     * @param  \App\Reviews  $reviews
     * @return mixed
     */
    public function delete(User $user, Reviews $reviews)
    {
        //
    }

    /**
     * Determine whether the user can restore the reviews.
     *
     * @param  \App\User  $user
     * @param  \App\Reviews  $reviews
     * @return mixed
     */
    public function restore(User $user, Reviews $reviews)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the reviews.
     *
     * @param  \App\User  $user
     * @param  \App\Reviews  $reviews
     * @return mixed
     */
    public function forceDelete(User $user, Reviews $reviews)
    {
        //
    }
}
