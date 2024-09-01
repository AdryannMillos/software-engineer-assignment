<?php

namespace App\Services;

use App\Repositories\Disposition\DispositionRepositoryInterface;
use App\Repositories\Candidate\CandidateRepositoryInterface;

class DispositionService
{
    protected $dispositionRepository;
    protected $candidateRepository;

    public function __construct(
        DispositionRepositoryInterface $dispositionRepository,
        CandidateRepositoryInterface $candidateRepository
    ) {
        $this->dispositionRepository = $dispositionRepository;
        $this->candidateRepository = $candidateRepository;
    }

    public function getAllDispositions($perPage = 15): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->dispositionRepository->all($perPage);
    }

    public function getDispositionById($id): array
    {
        $disposition = $this->dispositionRepository->find($id);

        if (!$disposition) {
            return ['message' => 'Disposition not found', 'status' => 404];
        }

        return ['data' => $disposition, 'status' => 200];
    }

    public function createDisposition(array $data): array
    {
        if (!isset($data['candidate_id']) || !$this->candidateRepository->find($data['candidate_id'])) {
            return ['message' => 'Candidate not found', 'status' => 404];
        }

        if ($data['disposition'] == 'hired') {
            if (!isset($data['hire_type'])) {
                return ['message' => 'Hire type is required', 'status' => 406];
            }
        }

        if ($data['disposition'] == 'rejected') {
            if (!isset($data['rejection_reason'])) {
                return ['message' => 'Rejection reason is required', 'status' => 406];
            }
        }

        if (isset($data['fee'])) {
            if (!isset($data['currency'])) {
                return ['message' => 'Currency is required', 'status' => 406];
            }
        }

        $disposition = $this->dispositionRepository->create($data);
        return ['data' => $disposition, 'message' => 'Disposition created successfully', 'status' => 201];
    }

    public function updateDisposition($id, array $data): array
    {
        $disposition = $this->dispositionRepository->find($id);

        if (!$disposition) {
            return ['message' => 'Disposition not found', 'status' => 404];
        }

        if (!$this->candidateRepository->find($data['candidate_id'])) {
            return ['message' => 'Candidate not found', 'status' => 404];
        }

        if ($data['disposition'] == 'hired') {
            if (!isset($data['hire_type'])) {
                return ['message' => 'Hire type is required', 'status' => 406];
            }
        }

        if ($data['disposition'] == 'rejected') {
            if (!isset($data['rejection_reason'])) {
                return ['message' => 'Rejection reason is required', 'status' => 406];
            }
        }

        if (isset($data['fee'])) {
            if (!isset($data['currency'])) {
                return ['message' => 'Currency is required', 'status' => 406];
            }
        }

        $updatedDisposition = $this->dispositionRepository->update($id, $data);

        return ['data' => $updatedDisposition, 'message' => 'Disposition updated successfully', 'status' => 200];
    }

    public function deleteDisposition($id): array
    {
        $disposition = $this->dispositionRepository->find($id);

        if (!$disposition) {
            return ['message' => 'Disposition not found', 'status' => 404];
        }

        $this->dispositionRepository->delete($id);

        return ['message' => 'Disposition deleted successfully', 'status' => 200];
    }
}
