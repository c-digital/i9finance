<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Utility;
use App\Customer;
use App\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

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
        $logo = asset(Storage::url('uploads/logo/'));

        $vars['[customer_name]'] = $contract->customer->name;
        $vars['[customer_contact]'] = $contract->customer->contact;
        $vars['[customer_email]'] = $contract->customer->email;

        $vars['[billing_name]'] = $contract->billing_name;
        $vars['[billing_country]'] = $contract->billing_country;
        $vars['[billing_state]'] = $contract->billing_state;
        $vars['[billing_city]'] = $contract->billing_city;
        $vars['[billing_phone]'] = $contract->billing_phone;
        $vars['[billing_zipcode]'] = $contract->billing_zipcode;
        $vars['[billing_address]'] = $contract->billing_address;

        $vars['[shipping_name]'] = $contract->shipping_name;
        $vars['[shipping_country]'] = $contract->shipping_country;
        $vars['[shipping_state]'] = $contract->shipping_state;
        $vars['[shipping_city]'] = $contract->shipping_city;
        $vars['[shipping_phone]'] = $contract->shipping_phone;
        $vars['[shipping_zipcode]'] = $contract->shipping_zipcode;
        $vars['[shipping_address]'] = $contract->shipping_address;

        $vars['[project]'] = $contract->project;
        $vars['[theme]'] = $contract->theme;
        $vars['[amount]'] = $contract->amount;
        $vars['[type]'] = $contract->type;
        $vars['[date_start]'] = $contract->date_start;
        $vars['[date_end]'] = $contract->date_end;

        return view('contracts.show', compact('contract', 'logo', 'vars'));
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
            'content'     => $request->content
        ]);

        return redirect('/contracts');
    }

    public function destroy($id)
    {
        Contract::find($id)->delete();
        return redirect('/contracts');
    }

    public function sign()
    {
        $sign = [
            'name' => request()->name,
            'date' => date('Y-m-d h:i:s'),
            'ip' => $_SERVER['REMOTE_ADDR'],
            'email' => request()->email
        ];

        $sign = json_encode($sign);

        $contract = Contract::find(request()->id);
        $contract->update(['sign' => $sign]);

        return redirect('/contracts/' . request()->id);
    }

    public function pdf($id)
    {
        $contract = Contract::find($id);

        $logo = asset(Storage::url('uploads/logo/'));

        $vars['[customer_name]'] = $contract->customer->name;
        $vars['[customer_contact]'] = $contract->customer->contact;
        $vars['[customer_email]'] = $contract->customer->email;

        $vars['[billing_name]'] = $contract->billing_name;
        $vars['[billing_country]'] = $contract->billing_country;
        $vars['[billing_state]'] = $contract->billing_state;
        $vars['[billing_city]'] = $contract->billing_city;
        $vars['[billing_phone]'] = $contract->billing_phone;
        $vars['[billing_zipcode]'] = $contract->billing_zipcode;
        $vars['[billing_address]'] = $contract->billing_address;

        $vars['[shipping_name]'] = $contract->shipping_name;
        $vars['[shipping_country]'] = $contract->shipping_country;
        $vars['[shipping_state]'] = $contract->shipping_state;
        $vars['[shipping_city]'] = $contract->shipping_city;
        $vars['[shipping_phone]'] = $contract->shipping_phone;
        $vars['[shipping_zipcode]'] = $contract->shipping_zipcode;
        $vars['[shipping_address]'] = $contract->shipping_address;

        $vars['[project]'] = $contract->project;
        $vars['[theme]'] = $contract->theme;
        $vars['[amount]'] = $contract->amount;
        $vars['[type]'] = $contract->type;
        $vars['[date_start]'] = $contract->date_start;
        $vars['[date_end]'] = $contract->date_end;

        $pdf = Pdf::loadView('contracts.pdf', compact('contract', 'logo', 'vars'));

        $filename = Str::slug($contract->theme) . '.pdf';

        return $pdf->download($filename);
    }

    public function print($id)
    {
        $contract = Contract::find($id);

        $logo = asset(Storage::url('uploads/logo/'));

        $vars['[customer_name]'] = $contract->customer->name;
        $vars['[customer_contact]'] = $contract->customer->contact;
        $vars['[customer_email]'] = $contract->customer->email;

        $vars['[billing_name]'] = $contract->billing_name;
        $vars['[billing_country]'] = $contract->billing_country;
        $vars['[billing_state]'] = $contract->billing_state;
        $vars['[billing_city]'] = $contract->billing_city;
        $vars['[billing_phone]'] = $contract->billing_phone;
        $vars['[billing_zipcode]'] = $contract->billing_zipcode;
        $vars['[billing_address]'] = $contract->billing_address;

        $vars['[shipping_name]'] = $contract->shipping_name;
        $vars['[shipping_country]'] = $contract->shipping_country;
        $vars['[shipping_state]'] = $contract->shipping_state;
        $vars['[shipping_city]'] = $contract->shipping_city;
        $vars['[shipping_phone]'] = $contract->shipping_phone;
        $vars['[shipping_zipcode]'] = $contract->shipping_zipcode;
        $vars['[shipping_address]'] = $contract->shipping_address;

        $vars['[project]'] = $contract->project;
        $vars['[theme]'] = $contract->theme;
        $vars['[amount]'] = $contract->amount;
        $vars['[type]'] = $contract->type;
        $vars['[date_start]'] = $contract->date_start;
        $vars['[date_end]'] = $contract->date_end;

        return view('contracts.print', compact('contract', 'logo', 'vars'));
    }
}
