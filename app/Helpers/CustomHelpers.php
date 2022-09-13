<?php

if (! function_exists('tenantRoute')) {
    function tenantRoute(string $route): string {
        return str_replace('://', '://' . tenant()->getTenantKey() . ".", $route);
    }
}