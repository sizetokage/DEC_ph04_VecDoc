<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use Inertia\Inertia;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Rules = Rule::getAllOrderByUpdated_at();
        // Genere_nameを$Rulesに追加
        foreach ($Rules as $Rule) {
            $Rule->genre_name = $Rule->genre->name;
        }
        //return response()->view('rule.index', compact("Rules"));
        return Inertia::render('Rule/Index', [
            'Rules' => $Rules,         
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $Documents = Rule::query()->find($id)->ruleDocuments()->orderBy('created_at', 'asc')->get();
        //return response()->view('rule.show', compact('Documents'));
        $Documents->map(function ($Document) {
            $Document->user_name = $Document->user->name;
            return $Document;
        });
        return Inertia::render('Rule/Show', [
            'Documents' => $Documents,         
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
