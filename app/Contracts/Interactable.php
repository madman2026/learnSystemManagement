<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Interaction\Services\InteractService;

trait Interactable
{
    public function comments(): MorphMany
    {
        return $this->morphMany(\Modules\Interaction\Models\Comment::class, 'commentable');
    }

    public function views(): MorphMany
    {
        return $this->morphMany(\Modules\Interaction\Models\View::class, 'viewable');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(\Modules\Interaction\Models\Like::class, 'likeable');
    }

    public function interact()
    {
        return app(InteractService::class);
    }
}
