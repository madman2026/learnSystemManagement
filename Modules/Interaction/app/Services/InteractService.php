<?php

namespace Modules\Interaction\Services;

use App\Contracts\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InteractService extends BaseService
{
    public function visit(Model $model): void
    {
        if (
            auth()->check() &&
            $model->views()
                ->where('user_id', auth()->id())
                ->exists()
        ) {
            return;
        }

        $model->views()->create([
            'ip_address' => request()->ip(),
            'user_id'    => auth()->id(),
        ]);
    }

    public function createComment(Model $commentable, array $data)
    {
        return $this->execute(function () use ($commentable, $data) {
            return $commentable->comments()->create([
                'user_id' => Auth::id(),
                'content' => $data['content'],
                'parent_id' => $data['parent_id'] ?? null,
            ]);
        }, 'error on submit comment!');
    }

    public function updateComment(Model $comment, array $data)
    {
        return $this->execute(function () use ($comment, $data) {
            if ($comment->user_id !== Auth::id()) {
                abort(403);
            }

            $comment->update([
                'text' => $data['text'],
            ]);

            return $comment;
        }, );
    }

    public function toggleLike(Model $likable)
    {
        return $this->execute(function () use ($likable) {
            $like = $likable->likes()
                ->where('user_id', Auth::id())
                ->first();

            if ($like) {
                $like->delete();
                return ['liked' => false];
            }

            $likable->likes()->create([
                'user_id' => Auth::id(),
            ]);

            return ['liked' => true];
        }, 'error on toggle like');
    }
}
