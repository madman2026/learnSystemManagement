<?php

namespace Modules\Interaction\Http\Requests;

use App\Contracts\ApiFormRequest;
use Modules\Interaction\Models\Comment;
use Modules\Interaction\Models\Interaction;

class UpdateCommentRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        /** @var Comment $interaction */
        $interaction = $this->route('Comment');

        return $interaction
            && $this->user()
            && $interaction->user_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'text' => [
                'required',
                'string',
                'min:1',
                'max:99999',
            ],
        ];
    }
}
