<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Models\Page;

class PageRepository implements PageRepositoryInterface
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->latest()->paginate(20);
    }

    public function find(int $id): ?Page
    {
        return $this->model->find($id);
    }

    public function create(array $data): Page
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
