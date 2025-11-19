<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerInformation as CustomerInformationData;

class CustomerInformation extends Controller
{
    public function index()
    {
        $customers = CustomerInformationData::all();
        return view('admin.users', compact('customers'));
    }
}
