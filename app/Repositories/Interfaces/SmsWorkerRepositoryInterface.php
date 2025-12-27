<?php

namespace App\Repositories\Interfaces;

use App\Models\SmsWorker;

interface SmsWorkerRepositoryInterface
{
    public function all();
    public function find(int $id): ?SmsWorker;
    public function create(array $data): SmsWorker;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
