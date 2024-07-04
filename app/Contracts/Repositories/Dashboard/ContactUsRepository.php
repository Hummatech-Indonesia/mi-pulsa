<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\ContactUsInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\About;
use App\Models\Contact;
use App\Models\ContactUs;

class ContactUsRepository extends BaseRepository implements ContactUsInterface
{
    public function __construct(ContactUs $contactUs)
    {
        $this->model = $contactUs;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->latest()->get();
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()->findOrFail($id)->update($data);
    }
}
