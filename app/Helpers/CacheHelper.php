<?php

use App\Services\CacheService;

if (!function_exists('cache_put')) {
    /**
     * Store a value in the cache with a given key and expiration time.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $minutes
     * @param string|null $tag
     * @return void
     */
    function cache_put(string $key, $value, ?int $minutes = 120, ?string $tag = null): void
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'put')) {
            if ($tag) {
                $cacheService->put($key, $value, $minutes, $tag);
            } else {
                $cacheService->put($key, $value, $minutes);
            }
        }
    }
}

if (!function_exists('cache_forever')) {
    /**
     * Store a value in the cache indefinitely.
     *
     * @param string $key
     * @param mixed $value
     * @param string|null $tag
     * @return void
     */
    function cache_forever(string $key, $value, ?string $tag = null): void
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'forever')) {
            if ($tag) {
                $cacheService->forever($key, $value, $tag);
            } else {
                $cacheService->forever($key, $value);
            }
        }
    }
}

if (!function_exists('cache_remember')) {
    /**
     * Retrieve a value from the cache by key, or execute a callback to store and return the value.
     *
     * @param string $key
     * @param \Closure $callback
     * @param int|null $minutes
     * @param string|null $tag
     * @return mixed
     */
    function cache_remember(string $key, \Closure $callback, ?int $minutes = 120, ?string $tag = null)
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'remember')) {
            if ($tag) {
                return $cacheService->remember($key, $callback, $minutes, $tag);
            }

            return $cacheService->remember($key, $callback, $minutes);
        }
    }
}

if (!function_exists('cache_get')) {
    /**
     * Retrieve a value from the cache by key.
     *
     * @param string $key
     * @param mixed|null $default
     * @param string|null $tag
     * @return mixed
     */
    function cache_get(string $key, $default = null, ?string $tag = null)
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'get')) {
            if ($tag) {
                return $cacheService->get($key, $default, $tag);
            }

            return $cacheService->get($key, $default);
        }
    }
}

if (!function_exists('cache_forget')) {
    /**
     * Remove a value from the cache by key.
     *
     * @param string $key
     * @param string|null $tag
     * @return void
     */
    function cache_forget(string $key, ?string $tag = null): void
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'forget')) {
            if ($tag) {
                $cacheService->forget($key, $tag);
            } else {
                $cacheService->forget($key);
            }
        }
    }
}

if (!function_exists('cache_clear')) {
    /**
     * Clear all cache for a specific tag or all cache if no tag is provided.
     *
     * @param string|null $tag
     * @return void
     */
    function cache_clear(?string $tag = null): void
    {
        $cacheService = app(CacheService::class);

        if (method_exists($cacheService, 'clear')) {
            if ($tag) {
                $cacheService->clear($tag);
            } else {
                $cacheService->clear();
            }
        }
    }
}
