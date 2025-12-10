<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Attendence;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendencePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Attendence');
    }

    public function view(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('View:Attendence');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Attendence');
    }

    public function update(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('Update:Attendence');
    }

    public function delete(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('Delete:Attendence');
    }

    public function restore(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('Restore:Attendence');
    }

    public function forceDelete(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('ForceDelete:Attendence');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Attendence');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Attendence');
    }

    public function replicate(AuthUser $authUser, Attendence $attendence): bool
    {
        return $authUser->can('Replicate:Attendence');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Attendence');
    }

}