<?php

if (! function_exists('tenantRoute')) {
    function tenantRoute(string $route, ?array $params = []): string {
        return route($route, ['tenant' => tenant(), ...$params]);
    }
}