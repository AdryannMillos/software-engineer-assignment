<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDispostionsRequest;
use App\Services\DispositionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DispositionsController extends Controller
{
    protected $dispositionService;

    public function __construct(DispositionService $dispositionService)
    {
        $this->dispositionService = $dispositionService;
    }

    public function index(): JsonResponse
    {
        try {
            $dispositions = $this->dispositionService->getAllDispositions();

            return response()->json($dispositions, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $disposition = $this->dispositionService->getDispositionById($id);

            return response()->json($disposition, $disposition['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreDispostionsRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            $disposition = $this->dispositionService->createDisposition($validated);

            return response()->json($disposition, $disposition['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(StoreDispostionsRequest $request, $id): JsonResponse
    {
        try {
            $validated = $request->validated();

            $disposition = $this->dispositionService->updateDisposition($id, $validated);

            return response()->json($disposition, $disposition['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $disposition = $this->dispositionService->deleteDisposition($id);

            return response()->json($disposition, $disposition['status']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
