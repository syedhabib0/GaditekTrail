<?php

namespace App\Interfaces;

interface UserInterface
{
    public function getAll($data);

    public function addUserDetails($data);
}