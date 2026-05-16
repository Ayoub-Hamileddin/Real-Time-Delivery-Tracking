<?php

use App\Services\Prometheus\PrometheusService;
use Illuminate\Support\Facades\Route;
use Prometheus\RenderTextFormat;


Route::get("/metrics", function(PrometheusService $prometheusService){
   $render = new RenderTextFormat();

   $result = $render->render(
        $prometheusService->getRegistry()->getMetricFamilySamples()
   );

   return response($result)
        ->header("Content-Type",RenderTextFormat::MIME_TYPE);
});
