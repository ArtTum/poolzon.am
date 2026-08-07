<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Order;
use App\Models\Social;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $page = $request->get('pageNum');
        $displayQuantity = $request->get('pageCount');
        $offset = ($page * $displayQuantity) - $displayQuantity;

        $query = Order::orderBy('id', 'Desc');
        $count = $query->count();

        if (ceil($count / $displayQuantity) > 0) {
            $paginateCount = ceil($count / $displayQuantity);
        } else {
            $paginateCount = 1;
        }

        $orders = $query
            ->offset($offset)
            ->limit($displayQuantity)
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'orders' => $orders,
            'displaying' => $orders->count(),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function view(Request $request)
    {
        $id = $request->id;
        $orderView = Order::find($id);

        return ['orderView' => $orderView, 'products' => unserialize($orderView->products)];
    }
}
