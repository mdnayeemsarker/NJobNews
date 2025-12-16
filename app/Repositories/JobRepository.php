<?php

namespace App\Repositories;

use App\Repositories\Interfaces\JobRepositoryInterface;
use App\Models\Job ;

class JobRepository implements JobRepositoryInterface
{
    protected $job;

    /**
     * JobRepository constructor.
     *
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Retrieve all categories with pagination.
     */
    public function all()
    {
        return $this->job->latest()->paginate(20);
    }

    /**
     * Find a job by ID.
     *
     * @param int $id
     * @return Job|null
     */
    public function find(int $id): ?Job
    {
        return $this->job->find($id);
    }

    /**
     * Create a new job.
     *
     * @param array $data
     * @return Job
     */
    public function create(array $data): Job
    {
        return $this->job->create($data);
    }

    /**
     * Update an existing job.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $job = $this->find($id);
        if ($job) {
            return $job->update($data);
        }
        return false;
    }

    /**
     * Delete a job.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $job = $this->find($id);
        if ($job) {
            return $job->delete();
        }
        return false;
    }
}
