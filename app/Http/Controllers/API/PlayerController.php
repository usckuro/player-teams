<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ResponseController;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\Team;

class PlayerController extends ResponseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @param Team $team
     * @return mixed
     */
    public function store(StorePlayerRequest $request, Team $team)
    {
        $request->merge(['team_id' => $team->id]);

        $player = Player::create($request->all());

        return ResponseController::Response($player);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlayerRequest $request
     * @param Team $team
     * @param Player $player
     * @return mixed
     */
    public function update(UpdatePlayerRequest $request, Team $team, Player $player)
    {
        if($request->has('team_id'))
        {
            if($request->team_id != $team->id)
                return ResponseController::CustomError('Invalid value sent');
        }

        $player->update($request->except('team_id'));

        return ResponseController::Response($player);
    }
}
