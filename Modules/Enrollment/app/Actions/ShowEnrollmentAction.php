<?php

namespace Modules\Enrollment\Actions;

use Exception;
use Modules\Course\Models\Course;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowEnrollmentAction
{
    public function handle(Course $course)
    {
        return auth()
            ->user()
            ->enrollments()
            ->where('course_id', $course->id)
            ->firstOrFail();
    }
}
