<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Models\Lang;
use App\Models\Appointment;
use App\Models\AppointmentLang;
use App\Models\Type;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
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
     */
    public function sort(Request $request){
        if ($request->sort){
            foreach ($request->sort as $k => $sort){
                $model = Appointment::find($sort['id']);
                $model->order_number = $k;
                $model->save();
            }
        }

    }

    /**
     * @param Request $request
     * @return array
     */
    public function filter(Request $request)
    {
        $searchWord = $request->get('searchWord');
        $page = $request->get('pageNum');
        $display_quantity = $request->get('pageCount');
        $offset = ($page * $display_quantity) - $display_quantity;

        $query = Appointment::select('id', 'order_number', 'appointment_status')
            ->with(['lang' => function ($q) {
                $q->select('appointment_id', 'lang_id', 'appointment_name');
            }]);

        if (!empty($searchWord)) {
            $query->orWhereHas('lang', function ($query) use ($searchWord) {
                $query->where('appointment_name', 'like', '%' . $searchWord . '%');
            });
        }

        $count = $query->count();

        if (ceil($count / $display_quantity) > 0) {
            $paginateCount = ceil($count / $display_quantity);
        } else {
            $paginateCount = 1;
        }

        $appointments = $query
            ->offset($offset)
            ->limit($display_quantity)
            ->orderBy('order_number')
            ->get();

        return [
            'offset' => $offset,
            'totalCount' => $count,
            'count' => $paginateCount ?? 1,
            'appointments' => $appointments,
            'displaying' => $appointments->count(),
        ];
    }

    /**
     * @param AppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create(['appointment_status' => 0]);
        $langs = Lang::all();
        foreach ($langs as $lang) {
            AppointmentLang::create([
                'lang_id' => $lang->id,
                'appointment_id' => $appointment->id,
                'appointment_name' => $request->get('appointment_name_' . $lang->iso),
            ]);
        }

        return response()->json(['success' => 'Done!']);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $appointmentForm = Appointment::select('id')
            ->where('id', $id)
            ->with(['lang' => function ($q) {
                $q->select('appointment_id', 'appointment_name');
            }])
            ->first();

        return ['appointmentForm' => $appointmentForm];
    }

    /**
     * @param AppointmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AppointmentRequest $request)
    {
        $id = $request->get('id');
        $query = Appointment::find($id);
        if (empty($query)) {
            return response()->json(['form' => null, 'error' => '404']);
        }

        $langs = Lang::all();
        foreach ($langs as $lang) {
            AppointmentLang::where('appointment_id', $id)
                ->where('lang_id', $lang->id)
                ->update([
                    'appointment_name' => $request->get('appointment_name_' . $lang->iso),
                ]);
        }
        return response()->json(['form' => 'success']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $model = Appointment::find($id);
        $model->delete();

        return response()->json('successfully deleted');
    }

    /**
     * @param Request $request
     */
    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $appointmentStatus = Appointment::select('appointment_status')
            ->where('id', $id)
            ->first();

        Appointment::where('id', $id)
            ->update([
                'appointment_status' => !$appointmentStatus->appointment_status
            ]);
    }
}
