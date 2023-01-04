<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Http\Requests\TeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Team;
use App\Traits\ApiResponseTrait;
use Exception;

class TeamController extends Controller
{

    use ApiResponseTrait;

    private $teamRepository;

    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function allTeams()
    {
        return $this->teamRepository->getAllData(["members"]);
    }

    public function isOwner(int $team_id)
    {
        if(auth()->user()->id !== $this->teamRepository->getOwnerId($team_id)){
           return $this->forbiddenResponse("Not the team owner");
        }
    }

    public function create(TeamRequest $request)
    {
        $data = $request->all();
        $data['owner_id'] = auth()->user()->id;

        try {
           $team =  $this->teamRepository->create($data);
        }catch(\Exception $e){
           return $this->errorResponse("Team Cannot be created");
        }
        return $this->successResponse($team, "Team Created Successfully");
    }

    public function addMember(MemberRequest $request)
    {
        $team_id = $request->input('team_id');
        $member_id = $request->input('member_id');

        $this->isOwner($team_id);

        try {
            $this->teamRepository->addMember($team_id, $member_id);
        }catch(Exception $e) {
            return  $this->errorResponse("This member can't be added");
        }

        return $this->successResponse("Member Assgined Successfully");
    }

    public function getTeamMembers(int $team_id) {
        $team = $this->teamRepository->getById($team_id);
        if(is_null($team)) return $this->notFoundResponse("Team Not Found");

        return $this->successResponse($team->members, "Members Listed Successfully");
    }

    public function removeMember(MemberRequest $request)
    {
        $team_id = $request->input('team_id');
        $member_id = $request->input('member_id');
        
        $this->isOwner($team_id);

        try {
            $this->teamRepository->removeMember($team_id, $member_id);
        } catch(\Exception $e){
            return $this->errorResponse("This member can't be removed");
        }
        return $this->successResponse("Member Removed Successfully");
    }

    public function update(TeamRequest $request, int $id)
    {
        $this->isOwner($id);
    
        try {
           $data = $this->teamRepository->update($id, ["name" => $request->input('name')]);
        } catch(\Exception $e) {
            return   $this->errorResponse("This team canno't be updated");
        }

        return  $this->successResponse($data, "Team update Successfully");
    }
}
