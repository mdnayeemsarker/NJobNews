<?php

namespace App\Repositories\Interfaces;

use App\Models\Ad;

interface AdsRepositoryInterface
{
    public function all();
    public function find(int $id): ?Ad;
    public function create(array $data): Ad;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
