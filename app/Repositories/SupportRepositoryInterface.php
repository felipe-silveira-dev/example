<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Interfaces\PaginationInterface;
use stdClass;

interface SupportRepositoryInterface
{
    public function getAll(string $filter = null): array;

    public function paginate(int $page, int $perPage = 10, string $filter = null): PaginationInterface;

    public function findOnebyId(int $id): object;

    public function store(CreateSupportDTO $dto): stdClass;

    public function update(UpdateSupportDTO $dto): stdClass;

    public function delete(int $id): bool;
}
