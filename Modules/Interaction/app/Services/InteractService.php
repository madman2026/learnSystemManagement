<?php

namespace Modules\Interaction\Services;

use App\Contracts\BaseService;
use Modules\Interaction\Enums\InteractableTypeEnum;

class InteractService extends BaseService
{
    public function visit(array $data)
    {
        $viewable = $data['type'];
        if (
            auth()->check() &&
            $viewable
                ->views()
                ->where("user_id", auth()->id())
                ->exists()
        ) {
            return;
        }
        $viewable->views()->create([
            "ip_address" => request()->ip(),
            "user_id" => auth()->check() ? auth()->id() : null,
        ]);
    }
    public function createComment(array $data)
    {

    }
    public function updateComment(array $data)
    {

    }
    public function toggleLike(array $data)
    {

    }
}
