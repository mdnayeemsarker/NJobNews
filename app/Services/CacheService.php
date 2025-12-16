<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    
    /**
     * Store a value in the cache with a given key and expiration time.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $minutes
     * @param string|null $tag
     * @return void
     */
    public function put(string $key, $value, ?int $minutes = 120, ?string $tag = null): void
    {
        if ($tag) {
            Cache::tags([$tag])->put($key, $value, now()->addMinutes($minutes));
        } else {
            Cache::put($key, $value, now()->addMinutes($minutes));
        }
    }

    /**
     * Store a value in the cache indefinitely.
     *
     * @param string $key
     * @param mixed $value
     * @param string|null $tag
     * @return void
     */
    public function forever(string $key, $value, ?string $tag = null): void
    {
        if ($tag) {
            Cache::tags([$tag])->forever($key, $value);
        } else {
            Cache::forever($key, $value);
        }
    }

    /**
     * Retrieve a value from the cache by key, or execute a callback to store and return the value.
     *
     * @param string $key
     * @param \Closure $callback
     * @param int|null $minutes
     * @param string|null $tag
     * @return mixed
     */
    public function remember(string $key, \Closure $callback, ?int $minutes = 120, ?string $tag = null)
    {
        if ($tag) {
            return Cache::tags([$tag])->remember($key, now()->addMinutes($minutes), $callback);
        }

        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }

    /**
     * Retrieve a value from the cache by key.
     *
     * @param string $key
     * @param mixed|null $default
     * @param string|null $tag
     * @return mixed
     */
    public function get(string $key, $default = null, ?string $tag = null)
    {
        if ($tag) {
            return Cache::tags([$tag])->get($key, $default);
        }

        return Cache::get($key, $default);
    }

    /**
     * Remove a value from the cache by key.
     *
     * @param string $key
     * @param string|null $tag
     * @return void
     */
    public function forget(string $key, ?string $tag = null): void
    {
        if ($tag) {
            Cache::tags([$tag])->forget($key);
        } else {
            Cache::forget($key);
        }
    }

    /**
     * Clear all cache for a specific tag or all cache if no tag is provided.
     *
     * @param string|null $tag
     * @return void
     */
    public function clear(?string $tag = null): void
    {
        if ($tag) {
            Cache::tags([$tag])->flush();
        } else {
            Cache::flush();
        }
    }
}
