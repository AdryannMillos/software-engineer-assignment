<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;

class CandidateRepository implements CandidateRepositoryInterface
{
    public function all($paginate = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Candidate::with('disposition')->paginate($paginate);
    }

    public function find($id): Candidate | null
    {
        return Candidate::with('disposition')->find($id);
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
        return Candidate::with('disposition')
            ->where($key, $value)
            ->get();
    }

    public function findByKeyExcept($key, $value, $exceptId): \Illuminate\Database\Eloquent\Collection
    {
        return Candidate::with('disposition')
            ->where($key, $value)
            ->where('id', '!=', $exceptId)
            ->get();
    }

    public function delete($id): bool
    {
        $candidate = $this->find($id);
        return $candidate->delete();
    }
}
