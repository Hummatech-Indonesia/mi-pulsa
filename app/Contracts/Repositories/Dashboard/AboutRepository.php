<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\About;

class AboutRepository extends BaseRepository implements AboutInterface
{
    public function __construct(About $about)
    {
        $this->model = $about;
    }
    public function get(): mixed
    {
        return $this->model->first();
    }
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }
}
