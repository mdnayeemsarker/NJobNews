<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AdsRepositoryInterface;
use App\Models\Ad;

class AdsRepository implements AdsRepositoryInterface
{
    protected $model;

    public function __construct(Ad $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->latest()->paginate(20);
    }

    public function find(int $id): ?Ad
    {
        return $this->model->find($id);
    }

    public function create(array $data): Ad
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
