<?php

namespace Modules\Interaction\Enums;

use Modules\Course\Models\Course;
use Modules\Lesson\Models\Lesson;

enum InteractableTypeEnum: string
{
    case COURSE = Course::class;
    case LESSON = Lesson::class;
}
