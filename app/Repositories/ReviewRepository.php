<?php

namespace App\Repositories;

use App\Interfaces\ReviewInterface;
use App\Models\Review;

class ReviewRepository implements ReviewInterface {

    protected $review;

    public function __construct(Review $review) {
        $this->review = $review;
    }

    public function create($data) {
        return $this->review->create($data);
    }

    public function userWithSameProduct($data) {
        return $this->review->where(['user_id' => $data['user_id'], 'product_id' => $data['product_id']])->count();
    }

    public function similarWordsByUser($data) {
        return $this->review->where('user_id', $data['user_id'])
                        ->where('content', 'like', '%' . $data['content'] . '%')
                        ->count();
    }

    public function getFakeReviews() {
        return $this->review->where('is_fake', 1)
                        ->get();
    }
}
