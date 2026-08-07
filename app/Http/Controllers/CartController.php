<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\OneOrderRequest;
use App\Http\Requests\TwoOrderRequest;
use App\Models\Order;
use Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class CartController extends Controller
{

    /**
     * @param string $lang
     * @return mixed
     */
    public function cart($lang = 'am')
    {
        App::setLocale($lang);
        $cartCollection = Cart::getContent();

        return view('pages.cart')->withTitle('E-COMMERCE STORE | CART')->with(['cartCollection' => $cartCollection]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $request->img,
            ]
        ]);
        return ['count' => Cart::getTotalQuantity()];
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(Request $request)
    {
        Cart::remove($request->id);
        return ['count' => Cart::getTotalQuantity(), 'id' => $request->id, 'totalPrice' => number_format(Cart::getTotal())];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function removeAll(Request $request)
    {
        $ids = explode(",", $request->ids);
        foreach ($ids as $id) {
            if ($id != "on") {
                Cart::remove($id);
            }
        }

        return ['count' => Cart::getTotalQuantity(), 'id' => $request->id, 'totalPrice' => number_format(Cart::getTotal())];
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clear(Request $request)
    {
        Cart::clear();

        return redirect()->route('cart.index')->with('success_msg', 'Item is Remove to Cart!');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {

        $quantity = $request->quantity - $request->oldQuantity;

        Cart::update($request->id, [
            'quantity' => $quantity,
        ]);

        return ['count' => Cart::getTotalQuantity(), 'totalPrice' => number_format(Cart::getTotal()), 'id' => $request->id, 'quantity' => $request->quantity,];
    }

    /**
     * @param string $lang
     * @return Application|Factory|View
     */
    public function orderInfo($lang = 'am')
    {
        App::setLocale($lang);
        $cartCollection = Cart::getContent();

        return view('pages.order.order-info', [
            'cartCollection' => $cartCollection,
        ]);
    }

    /**
     * @param string $lang
     * @return Application|Factory|View
     */
    public function stepOne(Request $request, $lang = 'am')
    {
        App::setLocale($lang);
        $one = $request->session()->get('one');

        return view('pages.order.step-one', [
            'one' => $one,
        ]);
    }

    /**
     * @param OneOrderRequest $request
     * @param $lang
     */
    public function orderOne(OneOrderRequest $request, $lang)
    {
        App::setLocale($lang);
        $request->session()->put('one', $request->all());

        return redirect(Helper::lang('step-two'));
    }

    /**
     * @param string $lang
     * @return Application|Factory|View
     */
    public function stepTwo(Request $request, $lang = 'am')
    {
        App::setLocale($lang);
        $two = $request->session()->get('two');
        if ($request->session()->has('one')) {
            return view('pages.order.step-two', [
                'two' => $two
            ]);
        } else {
            return redirect(Helper::lang());
        }
    }

    /**
     * @param string $lang
     * @return Application|Factory|View
     */
    public function stepThree(Request $request, $lang = 'am')
    {
        App::setLocale($lang);
        $two = $request->session()->get('two');
        $cartCollection = Cart::getContent();
        if ($request->session()->has('two')) {
            return view('pages.order.step-three', [
                'two' => $two,
                'cartCollection' => $cartCollection
            ]);
        } else {
            return redirect(Helper::lang());
        }
    }

    /**
     * @param TwoOrderRequest $request
     * @param $lang
     * @return Application|RedirectResponse|Redirector
     */
    public function orderTwo(TwoOrderRequest $request, $lang)
    {
        App::setLocale($lang);
        $request->session()->put('two', $request->all());

        return redirect(Helper::lang('step-three'));
    }

    /**
     * @param Request $request
     * @param $lang
     * @return Application|RedirectResponse|Redirector
     */
    public function order(Request $request, $lang)
    {
        App::setLocale($lang);

        $session1 = $request->session()->get('one');
        $session2 = $request->session()->get('two');
        $cartCollection = Cart::getContent();
        $products = serialize($cartCollection);

        $order = Order::create([
            'email' => $session1['email'],
            'first_name' => $session1['first_name'],
            'last_name' => $session1['last_name'],
            'phone' => $session1['phone'],
            'p_first_name' => $session1['p_first_name'],
            'p_last_name' => $session1['p_last_name'],
            'p_phone' => $session1['p_phone'],
            'address' => $session2['address'],
            'home' => $session2['home'],
            'entrance' => $session2['entrance'],
            'floor' => $session2['floor'],
            'intercom' => $session2['intercom'],
            'comment' => $session2['comment'],
            'products' => $products,
            'status' => 'Padding',
            'total_count' => Cart::getTotalQuantity(),
            'total_price' => Cart::getTotal(),
        ]);

        if ($request->payment_type == 'online') {

//            $ClientID = 'bd5cf7ea-5bf9-4b67-99ee-4b50432147fb';
//            $username = '19536356_api';
//            $password = 'mC7jW7uB6pD9tF9d';
//            $backURL = 'https://vagart.am/api/res';
//            $url = 'https://services.ameriabank.am/VPOS/api/VPOS/InitPayment';
//
//            $order->type = 1;
//            $order->save();
//
//            $price = $order->total_price + 3900;
//
//            $data = [
//                "ClientID" => $ClientID,
//                "Amount" => $price,
//                "OrderID" => $order->id,
//                "BackURL" => $backURL,
//                "Username" => $username,
//                "Password" => $password,
//                "Description" => 'Poolzone.am Product(s)',
//                "Currency" => "051",
//            ];
//
//            $data_string = json_encode($data);
//
//            $ch = curl_init($url);
//            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//                    'Content-Type: application/json',
//                    'Content-Length: ' . strlen($data_string))
//            );
//
//            $result = json_decode(curl_exec($ch));
//
//            if ($result->ResponseCode == '1' && $result->ResponseMessage == 'OK') {
//                echo "<script type='text/javascript'>\n";
//                echo "window.location.replace('https://services.ameriabank.am/VPOS/Payments/Pay?id=" . $result->PaymentID . "&lang=am');";
//                echo "</script>";
//            } else {
//                echo $result->ResponseMessage;
//                die;
//            }
        } else {
            $order->status = 'Success';
            $order->type = 2;
            $order->save();

            Mail::send('mail.order', [
                'order' => $order,
            ], function ($message) use ($order) {
                $message->to($order->email, 'poolzon.am order ' . $order->id)
                    ->subject('poolzon.am order ' . $order->id);
                $message->from('info@vagart.am', 'poolzon.am');
            });

            Mail::send('mail.order', [
                'order' => $order,
            ], function ($message) use ($order) {
                $message->to('info@vagart.am', 'poolzon.am order ' . $order->id)
                    ->subject('poolzon.am order ' . $order->id);
                $message->from('info@vagart.am', 'poolzon.am');
            });
            return redirect(Helper::lang('order-info') . '?order=' . $order->id);
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws SoapFault
     */
    public function res(Request $request)
    {
        App::setLocale('am');
        $id = $request->get('orderID');
        $orderID = substr($id, -2);
        $payment_id = $request->get('paymentID');
        $resposneCode = $request->resposneCode;
        $username = '19536356_api';
        $password = 'mC7jW7uB6pD9tF9d';
        $url = 'https://services.ameriabank.am/VPOS/api/VPOS/GetPaymentDetails';
        $order = Order::find($id);

        if ($resposneCode == '00') {
            $data = [
                "PaymentID" => $payment_id,
                "Username" => $username,
                "Password" => $password,
            ];

            $data_string = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            ]);

            $result = json_decode(curl_exec($ch));

            if ($result->ResponseCode == '00') {
                $order->status = 'Success';
                $order->type = 1;
                $order->payment_id = $payment_id;
                $order->save();

                Mail::send('mail.order', [
                    'order' => $order,
                ], function ($message) use ($order) {
                    $message->to($order->email, 'poolzon.am order ' . $order->id)
                        ->subject('poolzon.am order ' . $order->id);
                    $message->from('info@vagart.am', 'poolzon.am');
                });

                Mail::send('mail.order', [
                    'order' => $order,
                ], function ($message) use ($order) {
                    $message->to('info@vagart.am', 'poolzon.am order ' . $order->id)
                        ->subject('poolzon.am order ' . $order->id);
                    $message->from('info@vagart.am', 'poolzon.am');
                });
                return redirect(Helper::lang('order-info') . '?order=' . $order->id . '&paymentid=' . $payment_id);

            } else {
                die('error');
            }
        } else {
            $order->status = 'Error';
            $order->type = 1;
            $order->save();
            dd($request->all());
        }
    }
}
