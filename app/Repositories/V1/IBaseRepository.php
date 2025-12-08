<?php

namespace App\Repositories\V1;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}