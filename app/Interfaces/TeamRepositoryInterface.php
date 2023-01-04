<?php

namespace App\Interfaces;

use App\Interfaces\RepositoryInterface;

interface TeamRepositoryInterface extends RepositoryInterface {

    public function addMember(int $team_id, int $member_id): bool;
    public function removeMember(int $team_id, int $member_id): bool;
    public function getOwnerId(int $team_id): int;
}