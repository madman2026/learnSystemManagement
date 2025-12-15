<?php

namespace Modules\Interaction\Http\Requests;

use App\Contracts\ApiFormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;
use Modules\Interaction\Enums\InteractableTypeEnum;

class CreateCommentRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'text' => ['required', 'string', 'min:1', 'max:99999'],

            'type' => [
                'required',
                new Enum(InteractableTypeEnum::class),
            ],

            'id' => [
                'required',
                'integer',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (! $this->filled(['type', 'id'])) {
                return;
            }

            $modelClass = $this->type->value;

            if (! class_exists($modelClass)) {
                $validator->errors()->add('type', 'Invalid interactable type.');
                return;
            }

            if (! $modelClass::query()->whereKey($this->id)->exists()) {
                $validator->errors()->add(
                    'id',
                    "The selected record does not exist for given type."
                );
            }
        });
    }
}
