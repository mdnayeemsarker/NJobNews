<?php

namespace App\Repositories\Interfaces;

use App\Models\Job ;

interface JobRepositoryInterface
{
    /**
     * Retrieve all jobs with pagination.
     */
    public function all();

    /**
     * Find a job by ID.
     *
     * @param int $id
     * @return Job|null
     */
    public function find(int $id): ?Job;

    /**
     * Create a new job.
     *
     * @param array $data
     * @return Job
     */
    public function create(array $data): Job;

    /**
     * Update an existing job.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Delete a job.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
