<?php
namespace Indianic\CmsPages\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CmsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any cms pages.
     *
     * @param Admin $user
     * @return bool
     */
    public function viewAny(Admin $user): bool
    {
        return $user->hasPermissionTo('view cms-pages');
    }

    /**
     * Determine whether the user can view the cms-pages.
     *
     * @param Admin $user
     * @return bool
     */
    public function view(Admin $user): bool
    {
        return ( $user->hasPermissionTo('view cms-pages'));
    }

    /**
     * Determine whether the user can create cms-pages.
     *
     * @param Admin $user
     * @return bool
     */
    public function create(Admin $user): bool
    {
        return ( $user->hasPermissionTo('create cms-pages'));
    }

    /**
     * Determine whether the user can update the cms-pages.
     *
     * @param Admin $user
     * @return bool
     */
    public function update(Admin $user): bool
    {
        return $user->hasPermissionTo('update cms-pages');
    }

    /**
     * Determine whether the user can delete the cms-pages.
     *
     * @return Response|bool
     */
    public function delete(): Response|bool
    {
        return $user->hasPermissionTo('delete cms-pages');
    }
}
