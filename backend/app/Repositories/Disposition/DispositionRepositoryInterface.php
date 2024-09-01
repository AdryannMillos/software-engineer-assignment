<?php

namespace App\Repositories\Disposition;

interface DispositionRepositoryInterface
{
    public function all($perPage = 15);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
