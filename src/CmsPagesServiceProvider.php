<?php
namespace Indianic\CmsPages;

use Indianic\CmsPages\Nova\Resources\CmsPages;
use Indianic\CmsPages\Policies\CmsPagesPolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;

class CmsPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->setModulePermissions();

        Gate::policy(\Indianic\CmsPages\Models\CmsPages::class, CmsPagesPolicy::class);

        Nova::serving(function (ServingNova $event) {

            Nova::resources([
                CmsPages::class,
            ]);

        });

        if ($this->app->runningInConsole()) {

            tap(new Filesystem(), function ($filesystem) {

                $filesystem->copy(__DIR__ .'/../stubs/migrations/2023_01_19_045711_create_cmspages.stub', database_path('migrations/2023_01_19_045711_create_cmspages.php'));

                File::isDirectory(app_path('Providers/DataProviders')) or File::makeDirectory(app_path('Providers/DataProviders'), 0777, true, true);

                });

            $this->commands([
                CurrencyManagementCommand::class,
            ]);
        }

        // $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

        /**
     * Set Cms Pages module permissions
     *
     * @return void
     */


    private function setModulePermissions()
    {
        $existingPermissions = config('nova-permissions.permissions');

        $existingPermissions['view cms-page'] = [
            'display_name' => 'View cms page',
            'description'  => 'Can view cms page',
            'group'        => 'Cms Page'
        ];

        $existingPermissions['create cms-page'] = [
            'display_name' => 'Create cms page',
            'description'  => 'Can create cms page',
            'group'        => 'Cms Page'
        ];

        $existingPermissions['update cms-page'] = [
            'display_name' => 'Update cms page',
            'description'  => 'Can update cms page',
            'group'        => 'Cms Page'
        ];

        $existingPermissions['delete cms-page'] = [
            'display_name' => 'Delete cms page',
            'description'  => 'Can delete cms page',
            'group'        => 'Cms Page'
        ];

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }
}
