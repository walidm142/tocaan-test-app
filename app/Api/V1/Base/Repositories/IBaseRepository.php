<?php

namespace App\Api\V1\Base\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}