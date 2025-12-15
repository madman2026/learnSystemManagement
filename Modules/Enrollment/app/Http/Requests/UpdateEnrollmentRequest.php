<?php

namespace Modules\Enrollment\Http\Requests;

use App\Contracts\ApiFormRequest;
use Illuminate\Validation\Rules\Enum;
use Modules\Enrollment\Enums\EnrollmentStatus;

class UpdateEnrollmentRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(EnrollmentStatus::class)],
        ];
    }
}
