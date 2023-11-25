<?php

namespace App\Services;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(
        protected SupportRepositoryInterface $repository
    ) { }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOnebyId(int $id): stdClass
    {
        return $this->repository->findOnebyId($id);
    }

    public function store(CreateSupportDTO $dto): stdClass
    {
        return $this->repository->store($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
