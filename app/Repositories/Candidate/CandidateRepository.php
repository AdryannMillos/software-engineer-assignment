<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;

class CandidateRepository implements CandidateRepositoryInterface
{
    public function all($paginate = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Candidate::paginate($paginate);
    }

    public function find($id): Candidate | null
    {
        return Candidate::find($id);
    }

    public function create(array $data): Candidate
    {
        return Candidate::create($data);
    }

    public function update($id, array $data): Candidate
    {
        $candidate = $this->find($id);
        $candidate->update($data);
        return $candidate;
    }

    public function findByKey($key, $value): \Illuminate\Database\Eloquent\Collection
    {
        return Candidate::where($key, $value)->get();
    }

    public function findByKeyExcept($key, $value, $exceptId): \Illuminate\Database\Eloquent\Collection
    {
        return Candidate::where($key, $value)
            ->where('id', '!=', $exceptId)
            ->get();
    }


    public function delete($id): bool
    {
        $candidate = $this->find($id);
        return $candidate->delete();
    }
}
