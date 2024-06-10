<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Contracts\Interfaces\Dashboard\ContactInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\About;
use App\Models\Contact;

class ContactRepository extends BaseRepository implements ContactInterface
{
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
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
