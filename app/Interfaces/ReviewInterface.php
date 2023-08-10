<?php

namespace App\Interfaces;

interface ReviewInterface {

    public function create($data);

    public function userWithSameProduct($data);
    
    public function similarWordsByUser($data);
}
