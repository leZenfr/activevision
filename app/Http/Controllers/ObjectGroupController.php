<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectGroup;

class ObjectGroupController extends Controller
{
    /**
     * Affiche la liste des groupes.
     */
    public function index()
    {
        $objectGroups = ObjectGroup::all(); // Récupère tous les groupes
        return view('objectgroup', compact('objectGroups')); // Passe les données à la vue
    }

    /**
     * Affiche les détails d'un groupe.
     */
    public function show($objectSid)
    {
        $objectGroup = ObjectGroup::where('objectSid', $objectSid)->firstOrFail(); // Récupère le groupe par son SID
        return view('objectgroup-detail', compact('objectGroup')); // Passe les données à la vue
    }
}