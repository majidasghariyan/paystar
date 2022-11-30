<?php

namespace App\Repositories\bank;

use App\Models\Bank;
use App\Repositories\bank\BankRepositoryInterface;
use Illuminate\Http\Request;


class BankRepository implements BankRepositoryInterface
{
    public function get_all() 
    {
        return Bank::orderByDesc('id')->paginate(15)->appends(request()->except('page'));
    }

    public function createBank($request)
    {  
        Bank::create([
            'name' => $request->name,
        ]); 
    }

    public function updateBank($request, $bank)
    {

        $bank->update([
            'name' => $request->name,
        ]);
        
    }

    public function deleteBank($bank)
    {
        $bank->delete();
    }
}