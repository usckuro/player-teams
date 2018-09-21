<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;

class TeamController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::withCount('players')->get();

        return ResponseController::Response($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return mixed
     */
    public function store(StoreTeamRequest $request)
    {
        $team = Team::create($request->all());
        return ResponseController::Response($team);
    }

    /**
     * Display specific resource
     *
     * @param Team $team
     * @return mixed
     */
    public function show(Team $team)
    {
        $team->load('players');

        return ResponseController::Response($team);
    }
}
