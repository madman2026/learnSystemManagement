<?php

namespace Modules\Enrollment\Actions;

use Exception;
use Modules\Course\Models\Course;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowEnrollmentAction
{
    public function handle(Course $course)
    {
        if (auth()->user()->enrollments->where('course_id' , $course->id)->first()) {
            return auth()->user()->enrollments->where('course_id' , $course->id)->first();

        }
        return throw new NotFoundHttpException("User Not Registered On This Course");

    }
}
