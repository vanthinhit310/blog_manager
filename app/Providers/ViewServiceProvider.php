<?php


namespace App\Providers;


use App\Http\Views\Composers\Backend\MediaComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function viewComp()
    {
        $data   = [];
        $config = $this->app['config']->get('mediaManager');

        if ($config) {
            // base url
            $url = $this->app['filesystem']
                ->disk($config['storage_disk'])
                ->url('/');
            $data['base_url'] = preg_replace('/\/+$/', '/', $url);

            // upload panel bg patterns
            $pattern_path = public_path('assets/vendor/MediaManager/patterns');

            if ($this->file->exists($pattern_path)) {
                $patterns = collect(
                    $this->file->allFiles($pattern_path)
                )->map(function ($item) {
                    $name = str_replace('\\', '/', $item->getPathName());

                    return preg_replace('/.*\/patterns/', '/assets/vendor/MediaManager/patterns', $name);
                });

                $data['patterns'] = json_encode($patterns);
            }

            // share
            view()->composer('layouts.footers.modal-media', function ($view) use ($data) {
                $view->with($data);
            });
        }
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->file = $this->app['files'];
        $this->viewComp();
    }
}
