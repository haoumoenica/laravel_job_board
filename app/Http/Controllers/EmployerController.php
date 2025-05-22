<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class EmployerController extends Controller
{
    public function create(Request $request)
    {
        try {
            Gate::authorize('create', Employer::class);
        } catch (AuthorizationException $e) {
            return view('employer.create')->with('error', 'You already have an employer account.');
        }

        return view('employer.create');
    }

    public function store(Request $request)
    {
        try {
            Gate::authorize('create', Employer::class);
        } catch (AuthorizationException $e) {
            return redirect()->route('employer.create')
                ->with('error', 'You already have an employer account.');
        }

        $validated = $request->validate([
            'company_name' => 'required|min:3|unique:employers,company_name'
        ]);

        $request->user()->employer()->create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Your employer account was created!');
    }
}
