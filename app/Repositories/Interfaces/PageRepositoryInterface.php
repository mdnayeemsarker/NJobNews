<?php

namespace App\Repositories\Interfaces;

use App\Models\Page;

interface PageRepositoryInterface
{
    public function all();
    public function find(int $id): ?Page;
    public function create(array $data): Page;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
