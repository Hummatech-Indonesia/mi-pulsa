<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\RoleEnum;
use App\Enums\StatusDigiFlazzEnum;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private UserInterface $user;
    private TransactionInterface $transaction;
    private ProductInterface $product;
    private CustomerInterface $customer;

    public function __construct(UserInterface $user, ProductInterface $product, TransactionInterface $transaction, CustomerInterface $customer)
    {
        $this->user = $user;
        $this->customer = $customer;
        $this->transaction = $transaction;
        $this->product = $product;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if (UserHelper::getRole(auth()->user()) == RoleEnum::AGEN->value) {
            $customer_count = $this->customer->count();
            $transaction_count = $this->transaction->count_agen();
            $transaction_success_count = $this->transaction->count_agen_status(['status' => StatusDigiFlazzEnum::SUCCESS]);
            $transaction_failed_count = $this->transaction->count_agen_status(['status' => StatusDigiFlazzEnum::FAILED]);
            $customers = $this->customer->get();
            return view('dashboard.pages.dashboard-customer', compact('customer_count', 'transaction_count', 'transaction_success_count', 'transaction_failed_count', 'customers'));
        }

        $user_count = $this->user->count();
        $transaction_count = $this->transaction->count();
        $transaction_failed_count = $this->transaction->count_status(['status' => StatusDigiFlazzEnum::FAILED->value]);
        $product_count = $this->product->count();
        $users = $this->user->takeAgen();
        return view('dashboard.pages.index', compact('user_count', 'product_count', 'transaction_count', 'transaction_failed_count', 'users'));
    }
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
