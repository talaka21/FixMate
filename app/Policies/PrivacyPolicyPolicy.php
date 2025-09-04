<?php

namespace App\Policies;

use App\Models\PrivacyPolicy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivacyPolicyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
    return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
      public function view(User $user, PrivacyPolicy $privacyPolicy): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('غير مسموح لك بعرض سياسة الخصوصية.');
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
       return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
      public function update(User $user, PrivacyPolicy $privacyPolicy): Response
    {
        return $user->hasRole('admin')
            ? Response::allow()
            : Response::deny('غير مسموح لك بتعديل سياسة الخصوصية.');
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivacyPolicy $privacyPolicy): bool
    {
       return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivacyPolicy $privacyPolicy): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivacyPolicy $privacyPolicy): bool
    {
       return $user->hasRole('admin');
    }
}
