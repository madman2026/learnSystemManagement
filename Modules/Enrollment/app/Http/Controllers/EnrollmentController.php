<?php

namespace Modules\Enrollment\Http\Controllers;

use App\Contracts\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Course\Models\Course;
use Modules\Enrollment\Http\Requests\CreateEnrollmentRequest;
use Modules\Enrollment\Models\Enrollment;
use Modules\Enrollment\Services\EnrollmentService;

class EnrollmentController extends Controller
{
    public function __construct(private EnrollmentService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->service->index();
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Course $Course)
    {
        $result = $this->service->create($Course);
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message);
    }

    /**
     * Show the specified resource.
     */
    public function show(Course $Course)
    {
        $result = $this->service->get($Course);
        return $result->status
            ? ApiResponse::success($result->data, $result->message)
            : ApiResponse::error($result->message , $result->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json([]);
    }
}
