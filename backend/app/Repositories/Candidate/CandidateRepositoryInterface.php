<?php

namespace App\Repositories\Candidate;

interface CandidateRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByKey($key, $value);
    public function findByKeyExcept($key, $value, $exceptId);
}
