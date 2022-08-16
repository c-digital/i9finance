<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Customer;
use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::get();

        $now = Carbon::now()->format('Y-m-d');

        $active = Contract::where('date_end', '>=', $now)
            ->count();

        $expired = Contract::where('date_end', '<', $now)
            ->count();

        $next_monday = Carbon::parse('next monday')->format('Y-m-d');

        $about_to_expire = Contract::where('date_end', '<=', $next_monday)
            ->where('date_end', '>=', $now)
            ->count();

        $last_monday = Carbon::parse('last monday')->format('Y-m-d');

        $recently_added = Contract::where('date_start', '>=', $last_monday)
            ->count();

        return view('contracts.index', compact('contracts', 'active', 'expired', 'about_to_expire', 'recently_added'));
    }

    public function create()
    {
        $customers = Customer::get()->pluck('name', 'id');
        $customers->prepend(__(''), '');

        $projects = Project::get()->pluck('name', 'id');
        $projects->prepend(__(''), '');

        return view('contracts.create', compact('customers', 'projects'));
    }

    public function store(Request $request)
    {
        Contract::create([
            'customer_id' => $request->customer_id,
            'project_id'  => $request->project_id,
            'theme'       => $request->theme,
            'amount'      => $request->amount,
            'type'        => $request->type,
            'date_start'  => $request->date_start,
            'date_end'    => $request->date_end,
            'description' => $request->description
        ]);

        return redirect('/contracts');
    }

    public function show(Contract $contract)
    {
        $invoice = \App\Invoice::find($contract->id);
        $iteams   = $invoice->items;

        return view('contracts.show', compact('contract', 'invoice', 'iteams'));
    }

    public function edit($id)
    {
        $customers = Customer::get()->pluck('name', 'id');
        $customers->prepend(__(''), '');

        $projects = Project::get()->pluck('name', 'id');
        $projects->prepend(__(''), '');

        $contract = Contract::find($id);

        return view('contracts.edit', compact('contract', 'customers', 'projects'));
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update([
            'customer_id' => $request->customer_id,
            'project_id'  => $request->project_id,
            'theme'       => $request->theme,
            'amount'      => $request->amount,
            'type'        => $request->type,
            'date_start'  => $request->date_start,
            'date_end'    => $request->date_end,
            'description' => $request->description,
        ]);

        return redirect('/contracts');
    }

    public function destroy($id)
    {

    }
}
