<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SmsWorkerRepositoryInterface;
use App\Models\SmsWorker;

class SmsWorkerRepository implements SmsWorkerRepositoryInterface
{
    protected $model;

    public function __construct(SmsWorker $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->latest()->paginate(20);
    }

    public function find(int $id): ?SmsWorker
    {
        return $this->model->find($id);
    }

    public function create(array $data): SmsWorker
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $item = $this->find($id);
        return $item ? $item->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $item = $this->find($id);
        return $item ? $item->delete() : false;
    }
}
