<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Interfaces\PaginationInterface;
use App\Models\Support;
use stdClass;

class SupportEloquentORM implements SupportRepositoryInterface
{
    public function __construct(
        protected Support $model
    ) {
    }

    public function paginate(int $page = 1, int $perPage = 10, string $filter = null): PaginationInterface
    {
        // return new \stdClass();
        $supports = $this->model->select('id', 'subject', 'body', 'created_at', 'updated_at')
            ->when($filter, function ($query, $filter) {
                return $query->where('subject', 'like', "%{$filter}%");
                // ->orWhere('body', 'like', "%{$filter}%");
            })
            ->paginate($perPage, ['*'], 'page', $page);

        return new PaginationPresenter($supports);
    }

    public function getAll(string $filter = null): array
    {
        // return [];
        $supports = $this->model->select('id', 'subject', 'body', 'created_at', 'updated_at')
            ->when($filter, function ($query, $filter) {
                return $query->where('subject', 'like', "%{$filter}%");
                // ->orWhere('body', 'like', "%{$filter}%");
            })
            ->get();

        return $supports->toArray();
    }

    public function findOnebyId(int $id): object
    {
        // return new \stdClass();
        $support = $this->model->find($id);

        return (object) $support->toArray();
    }

    public function store(CreateSupportDTO $dto): stdClass
    {
        // return new \stdClass();
        $support = $this->model->create($dto->toArray());

        return (object) $support->toArray();
    }

    public function update(UpdateSupportDTO $dto): stdClass
    {
        // return new \stdClass();
        $support = $this->model->find($dto->id);

        $support->update($dto->toArray());

        return (object) $support->toArray();
    }

    public function delete(int $id): bool
    {
        // return true;
        $support = $this->model->find($id);

        return $support->delete();
    }
}
