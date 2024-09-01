<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;

class CandidateRepository implements CandidateRepositoryInterface
{
    public function all()
    {
        return Candidate::all();
    }

    public function find($id)
    {
        return Candidate::find($id);
    }

    public function create(array $data)
    {
        return Candidate::create($data);
    }

    public function update($id, array $data)
    {
        $candidate = $this->find($id);
        $candidate->update($data);
        return $candidate;
    }

    public function findByKey($key, $value)
    {
        return Candidate::where($key, $value)->get();
    }

    public function findByKeyExcept($key, $value, $exceptId)
{
    return Candidate::where($key, $value)
                    ->where('id', '!=', $exceptId)
                    ->get();
}


    public function delete($id)
    {
        $candidate = $this->find($id);
        return $candidate->delete();
    }
}
