<?php

namespace App\Repositories\Disposition;

use App\Models\Disposition;

class DispositionRepository implements DispositionRepositoryInterface
{
    public function all($perPage = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Disposition::paginate($perPage);
    }

    public function find($id): Disposition | null
    {
        return Disposition::find($id);
    }

    public function create(array $data): Disposition
    {
        return Disposition::create($data);
    }

    public function update($id, array $data): Disposition
    {
        $disposition = $this->find($id);
        $disposition->update($data);
        return $disposition;
    }

    public function delete($id): bool
    {
        $disposition = $this->find($id);
        return $disposition->delete();
    }
}
