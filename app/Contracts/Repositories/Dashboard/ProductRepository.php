<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Traits\Datatables\UserDatatable;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }
    /**
     * Method get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()->get();
    }

    /**
     * search
     *
     * @param  mixed $request
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('product_name', 'like', '%' . $request->search . '%')->orWhere('buyer_sku_code', $request->search);
            })
            ->fastPaginate(5);
    }
    /**
     * Method getPriceList
     *
     * @param Request $request [explicite description]
     *
     * @return mixed
     */
    public function getPriceList(Request $request): mixed
    {
        return $this->model->query()->when($request->search, function ($query) use ($request) {
            $query->where('product_name', 'like', '%' . $request->search . '%')->orWhere('buyer_sku_code', $request->search);
        })
            ->fastPaginate(5);
    }
    /**
     * Method store
     *
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    /**
     * Method show
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }
    /**
     * Method update
     *
     * @param mixed $id [explicite description]
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->show($id)->update($data);
    }
    /**
     * Method delete
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getWhere(array $data): mixed
    {
        return $this->model->query()
            ->where('product_name', $data['product_name'])
            ->first();
    }

    /**
     * getProduct
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getProduct(array $data): mixed
    {
        return $this->model->query()
            ->where('buyer_sku_code', $data['buyer_sku_code'])
            ->first();
    }

    /**
     * count
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->query()
            ->count();
    }
}
