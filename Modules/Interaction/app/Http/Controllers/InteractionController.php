<?php

namespace Modules\Interaction\Http\Controllers;

use App\Contracts\ApiResponse;
use App\Http\Controllers\Controller;
use Modules\Interaction\Http\Requests\CreateCommentRequest;
use Modules\Interaction\Http\Requests\ToggleLikeRequest;
use Modules\Interaction\Http\Requests\UpdateCommentRequest;
use Modules\Interaction\Http\Requests\VisitRequest;
use Modules\Interaction\Models\Comment;
use Modules\Interaction\Services\InteractService;

class InteractionController extends Controller
{
    public function __construct(private InteractService $service){}

    public function createComment(CreateCommentRequest $request)
    {
        $result = $this->service->createComment($request->validated());
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function toggleLike(ToggleLikeRequest $request)
    {
        $result = $this->service->toggleLike($request->validated());
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);
    }

    /**
     * Show the specified resource.
     */
    public function visit(VisitRequest $request)
    {
        $result = $this->service->visit($request->validated());
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateComment(UpdateCommentRequest $request)
    {
        $result = $this->service->updateComment($request->validated());
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteComment(int $id)
    {
        $result = Comment::findOrFail($id)?->delete();
        return $result->status
            ? ApiResponse::success(message: 'delete comment successfully!')
            : ApiResponse::error('somthing wen wrong!');
    }
}
