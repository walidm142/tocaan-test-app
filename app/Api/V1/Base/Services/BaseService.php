<?php

namespace App\Api\V1\Base\Services;

use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Base\Repositories\IBaseRepository;

class BaseService implements IBaseService
{
    protected $repository;

    public function __construct(IBaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($record, array $data)
    {
        return $this->repository->update($record, $data);

    }

    public function delete($record)
    {
        return $this->repository->delete($record);
    }
}