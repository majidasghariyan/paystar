<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\Bank\StoreBankRequest;
use App\Repositories\bank\BankRepositoryInterface;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Variable to hold injected dependency
     */

    private $repository;

    /**
     * 
     * Initializing the instances and variables
     *
     */
  
    public function __construct(BankRepositoryInterface $bankRepository){
      $this->repository = $bankRepository;
    }

    public function index()
    { 
        $title = "لیست بانک ها";
        $subtitle = "بانک ها";
        $banks = $this->repository->get_all();
        return view('admin.banks.index', compact('banks', 'title', 'subtitle'));
    }

    public function create()
    {
      return view('admin.banks.create');
    }

    public function store(StoreBankRequest $request)
    {
      $this->repository->createBank($request);
      alert_message('با موفقیت ثبت شد','success');
      return redirect()->back();
    }

    public function edit(Bank $bank)
    {
      return view('admin.banks.edit', compact('bank'));
    }

    public function update(StoreBankRequest $request,Bank $bank)
    {
      $this->repository->updateBank($request, $bank);
      alert_message('با موفقیت ویرایش شد','success');
      return redirect()->back();
    }

    public function delete(Bank $bank)
    {
      $this->repository->deleteBank($bank);
      alert_message('با موفقیت حذف شد','success');
      return back();
    }
}
