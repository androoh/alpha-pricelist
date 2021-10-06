<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Cknow\Money\Money;

class AppServiceProvider extends ServiceProvider
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('price', function (...$params) {
            $params = is_array($params) && count($params) > 0 ? explode(',', $params[0]) : null;
            if ($params) {
                return "<?php echo money($params[0])->formatByFormatter(new App\Money\CustomFormatter($params[1])); ?>";
            }
            return "<?php echo ''; ?>";
        });

        Blade::directive('t', function (...$params) {
            $params = is_array($params) && count($params) > 0 ? explode(',', $params[0]) : null;
            if ($params) {
                $data = trim($params[0]);
                $path = trim($params[1]);
                $defaultValue = isset($params[2]) ? trim($params[2]) : 'null';
                $locale = isset($params[3]) ? trim($params[3]) : 'null';
                return "<?php echo translateFromPath({$data}, {$path}, {$defaultValue}, {$locale});?>";
            }
            return "<?php echo ''; ?>";
        });
    }
}
