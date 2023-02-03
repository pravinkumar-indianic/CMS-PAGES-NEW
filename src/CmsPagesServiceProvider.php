<?php
namespace Indianic\CmsPages;


use Laravel\Nova\Nova;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Indianic\CmsPages\Nova\Resources\CmsPages;
use Indianic\CmsPages\Policies\CmsPolicy;

class CmsPagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
//         $this->setModulePermissions();

//         Gate::policy(\Indianic\CmsPages\Models\CmsPages::class, CmsPolicy::class);

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

        $existingPermissions['view cms-pages'] = [
            'display_name' => 'View cms pages',
            'description'  => 'Can view cms pages',
            'group'        => 'Cms Pages'
        ];

        $existingPermissions['create cms-pages'] = [
            'display_name' => 'Create cms pages',
            'description'  => 'Can create cms pages',
            'group'        => 'Cms Page'
        ];

        $existingPermissions['update cms-pages'] = [
            'display_name' => 'Update cms pages',
            'description'  => 'Can update cms pages',
            'group'        => 'Cms Pages'
        ];

        $existingPermissions['delete cms-pages'] = [
            'display_name' => 'Delete cms pages',
            'description'  => 'Can delete cms pages',
            'group'        => 'Cms Pages'
        ];

        \Config::set('nova-permissions.permissions', $existingPermissions);
    }
}
