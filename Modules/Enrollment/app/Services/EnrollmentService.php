<?php

namespace Modules\Enrollment\Services;

use App\Contracts\BaseService;
use Exception;
use Modules\Course\Models\Course;
use Modules\Enrollment\Actions\CheckEnrollmentAction;
use Modules\Enrollment\Actions\CreateEnrollmentAction;
use Modules\Enrollment\Actions\DeleteEnrollmentAction;
use Modules\Enrollment\Actions\IndexEnrollmentAction;
use Modules\Enrollment\Actions\ShowEnrollmentAction;
use Modules\Enrollment\Actions\UpdateEnrollmentAction;
use Modules\Enrollment\Models\Enrollment;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EnrollmentService extends BaseService
{
    public function __construct(
        private CreateEnrollmentAction $createAction,
        private UpdateEnrollmentAction $updateAction,
        private CheckEnrollmentAction $checkAction,
        private DeleteEnrollmentAction $deleteAction,
        private IndexEnrollmentAction $indexAction,
        private ShowEnrollmentAction $showAction,
    ) {}

    public function create(Course $course)
    {
        return $this->execute(fn() => $this->createAction->handle($course));
    }

    public function update(Course $course, array $data)
    {
        return $this->execute(
            fn() => $this->updateAction->handle($course, $data),
        );
    }

    public function check(Course $course)
    {
        return $this->execute(fn() => $this->checkAction->handle($course));
    }

    public function delete(Course $course)
    {
        return $this->execute(fn() => $this->deleteAction->handle($course));
    }

    public function index()
    {
        return $this->execute(fn() => $this->indexAction->handle());
    }

    public function get(Course $course)
    {
        if ($this->check($course))
        {
            return $this->execute(fn() => $this->showAction->handle($course));
        }
        return throw new NotFoundHttpException("Course Not Found!");

    }
}
