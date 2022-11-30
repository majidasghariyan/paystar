<?php

namespace App\Repositories\bank;

interface BankRepositoryInterface 
{
    public function get_all();

    public function createBank($request);

    public function updateBank($request, $bank);

    public function deleteBank($bank);

}