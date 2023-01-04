<?php

namespace App\Repositories;

use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface {

    public function __construct(Team $model)
    {
        parent::__construct($model);
    }

    public function getAllTeams() {
        return $this->model->getAllData();
    }
    
    public function getOwnerId($team_id) :int {
        return $this->getById($team_id)->owner->id;
    }

    public function addMember(int $team_id, int $member_id): bool {
        return (!$this->getMembers($team_id)->attach($member_id));
    }

    public function removeMember(int $team_id, int $member_id): bool {
        return  (!$this->getMembers($team_id)->detach($member_id));   
    }

    public function getMembers(int $team_id) {
        return $this->getById($team_id)->members();
    }

    public function getMemberById(int $member_id)
    {
        return $this->getById($member_id);
    }
}