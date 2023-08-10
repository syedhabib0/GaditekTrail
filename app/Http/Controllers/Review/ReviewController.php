<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function create(Request $request)
    {
        return $this->reviewService->create($request->all());
    }

    public function fakeReviews()
    {
        return $this->reviewService->fakeReviews();
    }
}
