<?php

namespace Jgile\Clip;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Jgile\Clip\View\ClipImg;

class ClipServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/clip.php', 'clip');

        $this->app->singleton(Clip::class, function ($app) {
            return new Clip(Storage::disk(config('clip.disk')));
        });
    }

    public function boot(): void
    {
        $this->bootResources();
        $this->bootBladeComponents();
        $this->bootDirectives();
        $this->bootPublishing();
    }

    private function bootResources(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'clip');
    }

    private function bootBladeComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            $blade->component(ClipImg::class, 'img', 'clip');
        });
    }

    private function bootDirectives(): void
    {
        Blade::directive('clip', function (string $expression) {
            return "<?php echo app(\\Jgile\\Clip\\Clip::class)->url($expression); ?>";
        });
    }

    private function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/clip.php' => config_path('clip.php'),
            ], 'clip.config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/clip'),
            ], 'clip.views');
        }
    }
}
