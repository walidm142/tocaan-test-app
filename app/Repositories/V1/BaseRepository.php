<?php

namespace App\Repositories\V1;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\V1\IBaseRepository;
use Illuminate\Pipeline\Pipeline;

class BaseRepository implements IBaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all($perPage = 10)
    {
        $paginated = app(Pipeline::class)
            ->send($this->model->query())
            ->through($this->model->getPipelineStages())
            ->thenReturn()
            ->paginate($perPage);

        return [
            'data' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
            ],
        ];
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update($record, array $data)
    {
        if ($record) {
            $record->update($data);
            return $record->refresh();
        }
        return null;
    }
    public function delete($record)
    {
        if ($record) {
            $record->delete();
            return true;
        }
        return false;
    }
}