<?php

namespace Modules\Enrollment\Enums;

enum EnrollmentStatus: string
{
    case PENDING = "pending";
    case COMPLETED = "completed";
    case CANCELLED = "cancelled";
    case FAILED = "failed";
}
