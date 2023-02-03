<?php
namespace Indianic\CMSPages;

use Indianic\CMSPages\Nova\Resources\CMSPage;
use Indianic\CMSPages\Policies\CMSPagePolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class CMSPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setModulePermissions();

        Gate::policy(\Indianic\CMSPages\Models\CMSPage::class, CMSPagePolicy::class);

        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                CMSPage::class,
            ]);

        });

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Set Cms Pages module permissions
     *
     * @return void
     */
    private function setModulePermissions(): void
    {
        $existingPermissions = config('nova-permissions.permissions');

        $existingPermissions['view cms-pages'] = [
            'display_name' => 'View cms pages',
            'description'  => 'Can view cms pages',
            'group'        => 'CMS Page'
        ];

        $existingPermissions['create cms-pages'] = [
            'display_name' => 'Create cms pages',
            'description'  => 'Can create cms pages',
            'group'        => 'CMS Page'
        ];

        $existingPermissions['update cms-pages'] = [
            'display_name' => 'Update cms pages',
            'description'  => 'Can update cms pages',
            'group'        => 'CMS Page'
        ];

        $existingPermissions['delete cms-pages'] = [
            'display_name' => 'Delete cms pages',
            'description'  => 'Can delete cms pages',
            'group'        => 'CMS Page'
        ];

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }
}

