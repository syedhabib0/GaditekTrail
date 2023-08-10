<?php

namespace App\Services;

use App\Models\Keyword;
use App\Repositories\ReviewRepository;

class ReviewService {

    protected $reviewRepository;

    public function __construct(
            ReviewRepository $reviewRepository
    ) {
        $this->reviewRepository = $reviewRepository;
    }

    public function create($data) {
        $data['user_id'] = auth()->user()->id;

        $extractedKeywords = explode(' ', $data['content']);

        // Compare extracted keywords with keywords in the database
        $fakeKeywords = Keyword::whereIn('name', $extractedKeywords)->count();

        // User with same tone or words on different products        
        $similarWordsByUser = $this->reviewRepository->similarWordsByUser($data);

        // User with same product count
        $userWithSameProduct = $this->reviewRepository->userWithSameProduct($data);

        $fakeThreshold = 5;
        if (($fakeKeywords > $fakeThreshold) || ($similarWordsByUser > $fakeThreshold || ($userWithSameProduct > $fakeThreshold))) {
            $data['is_fake'] = 1;
        }
        
        return $this->reviewRepository->create($data);
    }

    public function fakeReviews() {
        
        return $this->reviewRepository->getFakeReviews();
    }
}
