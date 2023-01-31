<?php
namespace Indianic\CmsPages;


use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Indianic\CmsPages\Nova\Resources\CmsPages;
use Indianic\CmsPages\Policies\CmsPagesPolicy;

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

            $this->loadMigrationsFrom(base_path('vendor/indianic/cms-pages/database/migrations'));
            $path = 'vendor/indianic/cms-pages/database';
            $migrationPath = $path."/migrations";
            if (is_dir($migrationPath)) {
                foreach (array_diff(scandir($migrationPath, SCANDIR_SORT_NONE), [".",".."]) as $migration) {
                    Artisan::call('migrate', [
                        '--path' => $migrationPath."/".$migration
                    ]);
                }
            }
        }
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

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
