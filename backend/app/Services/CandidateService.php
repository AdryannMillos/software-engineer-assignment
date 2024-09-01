<?php

namespace App\Services;

use App\Repositories\Candidate\CandidateRepositoryInterface;

class CandidateService
{
    protected $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function getAllCandidates($perPage = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->candidateRepository->all($perPage);
    }

    public function getCandidateById($id): array
    {
        $candidate = $this->candidateRepository->find($id);

        if (!$candidate) {
            return ['message' => 'Candidate not found', 'status' => 404];
        }

        return ['data' => $candidate, 'status' => 200];
    }

    public function createCandidate(array $data): array
    {
        $emailFound = $this->candidateRepository->findByKey('email', $data['email']);

        if ($emailFound->count() > 0) {
            return ['message' => 'Email already exists', 'status' => 406];
        }

        if (isset($data['phone'])) {
            $phoneFound = $this->candidateRepository->findByKey('phone', $data['phone']);

            if ($phoneFound->count() > 0) {
                return ['message' => 'Phone already exists', 'status' => 406];
            }
        }

        $newCandidate = $this->candidateRepository->create($data);

        return ['data' => $newCandidate, 'message' => 'Candidate created successfully', 'status' => 201];
    }

    public function updateCandidate($id, array $data): array
    {
        $candidate = $this->candidateRepository->find($id);

        if (!$candidate) {
            return ['message' => 'Candidate not found', 'status' => 404];
        }

        $emailFound = $this->candidateRepository->findByKeyExcept('email', $data['email'], $id);

        if ($emailFound->count() > 0) {
            return ['message' => 'Email already exists', 'status' => 406];
        }

        if (isset($data['phone'])) {
            $phoneFound = $this->candidateRepository->findByKeyExcept('phone', $data['phone'], $id);

            if ($phoneFound->count() > 0) {
                return ['message' => 'Phone already exists', 'status' => 406];
            }
        }

        $updatedCandidate = $this->candidateRepository->update($id, $data);

        return ['data' => $updatedCandidate, 'message' => 'Candidate updated successfully', 'status' => 200];
    }

    public function deleteCandidate($id): array
    {
        $candidate = $this->candidateRepository->find($id);

        if (!$candidate) {
            return ['message' => 'Candidate not found', 'status' => 404];
        }

        $this->candidateRepository->delete($id);

        return ['message' => 'Candidate deleted successfully', 'status' => 200];
    }
}
