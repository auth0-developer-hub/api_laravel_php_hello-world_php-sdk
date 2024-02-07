<?php

namespace App\Http\Controllers;

use App\Services\MessageServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MessagesController extends Controller
{
    public function showPublicMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return response()->json($messageService->getPublicMessage()->toArray());
    }

    public function showAdminMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return response()->json($messageService->getAdminMessage()->toArray());
    }

    public function showProtectedMessage(MessageServiceInterface $messageService): JsonResponse
    {
        return response()->json($messageService->getProtectedMessage()->toArray());
    }
}
