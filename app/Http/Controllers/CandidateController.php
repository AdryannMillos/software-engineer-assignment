<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateRequest;
use App\Services\CandidateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index(): JsonResponse
    {
        try {
            $candidates = $this->candidateService->getAllCandidates();

            return response()->json($candidates, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $candidate = $this->candidateService->getCandidateById($id);

            return response()->json($candidate, $candidate['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreCandidateRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $candidate = $this->candidateService->createCandidate($validated);

            return response()->json($candidate, $candidate['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(StoreCandidateRequest $request, $id): JsonResponse
    {
        try {
            $validated = $request->validated();

            $candidate = $this->candidateService->updateCandidate($id, $validated);

            return response()->json($candidate, $candidate['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
      try {
          $candidate = $this->candidateService->deleteCandidate($id);

          return response()->json($candidate, $candidate['status']);
      } catch (\Exception $e) {
          return response()->json(['error' => $e->getMessage()], 500);
      }
    }
}
