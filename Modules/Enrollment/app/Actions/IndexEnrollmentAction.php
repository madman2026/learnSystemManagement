<?php

namespace Modules\Enrollment\Actions;

class IndexEnrollmentAction
{
    public function handle() {
        return auth()->user()->enrollments()->with('course');
    }
}
