<?php

namespace App\Policies;

use App\Models\User;
use App\Models\somnong_collect_payment;
use Illuminate\Auth\Access\Response;

class SomnongCollectPaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, somnong_collect_payment $somnongCollectPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, somnong_collect_payment $somnongCollectPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, somnong_collect_payment $somnongCollectPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, somnong_collect_payment $somnongCollectPayment): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, somnong_collect_payment $somnongCollectPayment): bool
    {
        //
    }
}
