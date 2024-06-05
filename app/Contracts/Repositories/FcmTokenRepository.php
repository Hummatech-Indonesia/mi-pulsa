<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Models\User;

class FcmTokenRepository extends BaseRepository implements FcmTokenInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->where('email', 'admin@gmail.com')
            ->firstOrFail();
    }
}
