<?php

namespace App\Repositories;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Interfaces\PaginationInterface;
use Illuminate\Support\Facades\DB;
use stdClass;

class SupportRepository implements SupportRepositoryInterface
{
    public function paginate(int $page, int $perPage = 10, string $filter = null): PaginationInterface
    {
        $supports = DB::table('supports')
            ->select('id', 'subject', 'body', 'created_at', 'updated_at')
            ->when($filter, function ($query, $filter) {
                return $query->where('subject', 'like', "%{$filter}%");
                // ->orWhere('body', 'like', "%{$filter}%");
            })
            ->paginate($perPage, ['*'], 'page', $page);

        return new PaginationPresenter($supports);
    }

    public function getAll(string $filter = null): array
    {
        $supports = DB::table('supports')
            ->select('id', 'subject', 'body', 'created_at', 'updated_at')
            ->get();

        return $supports->toArray();
    }

    public function findOnebyId(int $id): object
    {
        return new \stdClass();
    }

    public function store(CreateSupportDTO $dto): stdClass
    {
        return new \stdClass();
    }

    public function update(UpdateSupportDTO $dto): stdClass
    {
        return new \stdClass();
    }

    public function delete(int $id): bool
    {
        return true;
    }
}
