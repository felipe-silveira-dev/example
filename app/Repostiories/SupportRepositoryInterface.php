<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Interfaces\BaseRepository;
use stdClass;

interface SupportRepositoryInterface extends BaseRepository
{
    public function store(CreateSupportDTO $dto): stdClass;
    public function update(UpdateSupportDTO $dto): stdClass;
}
