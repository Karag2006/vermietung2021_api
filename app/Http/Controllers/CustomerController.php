<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    //Schütze alle Controller Funktionen mit passport
    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerList = Customer::select('id', 'name1', 'name2', 'city', 'plz')->orderBy('name1')->get();
        return response()->json($customerList, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // Validate the Input
            $this->validate($request, [
                'pass_number'           =>  'nullable|string|min:8|max:30',
                'name1'                 =>  'required|string|max:50',
                'name2'                 =>  'nullable|string|max:50',
                'street'                =>  'nullable|string|min:3|max:50',
                'plz'                   =>  'nullable|digits_between:4,5',
                'city'                  =>  'nullable|string|min:3|max:50',
                'birth_date'            =>  'nullable|date_format:d.m.Y',
                'birth_city'            =>  'nullable|string|min:3|max:50',
                'phone'                 =>  'nullable|string|min:6|max:15',
                'car_number'            =>  'nullable|string|min:5|max:20',
                'email'                 =>  'nullable|email',
                'driving_license_no'    =>  'nullable|string|min:6|max:15',
                'driving_license_class' =>  'nullable|string|max:9',
                'comment'               =>  'nullable|string|max:1000'
            ]);

            $customer = Customer::create($request->all());

            // for the Response limit the elements of the newly created Customer
            // to those that are also transfered in the Ressource List.
            $customer = $customer->only([
                'id',
                'name1',
                'name2',
                'plz',
                'city',
            ]);

            // Return the shortened entry of the new Customer to the Frontend,
            // so the Frontend can update its own List, with the Validated Data
            return response()->json($customer, Response::HTTP_CREATED);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // if (Gate::allows("view", Customer::class)) {
        //    return $customer;
        // }
        $customer = $customer->only([
                'id',
                'pass_number',
                'name1',
                'name2',
                'street',
                'plz',
                'city',
                'birth_date',
                'birth_city',
                'phone',
                'car_number',
                'email',
                'driving_license_no',
                'driving_license_class',
                'comment'
            ]);
        return response()->json($customer, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {


        // Validate Input
        $this->validate($request, [
                'pass_number'           =>  'nullable|string|min:8|max:30',
                'name1'                 =>  'required|string|max:50',
                'name2'                 =>  'nullable|string|max:50',
                'street'                =>  'nullable|string|min:3|max:50',
                'plz'                   =>  'nullable|digits_between:4,5',
                'city'                  =>  'nullable|string|min:3|max:50',
                'birth_date'            =>  'nullable|date_format:d.m.Y',
                'birth_city'            =>  'nullable|string|min:3|max:50',
                'phone'                 =>  'nullable|string|min:6|max:15',
                'car_number'            =>  'nullable|string|min:5|max:20',
                'email'                 =>  'nullable|email',
                'driving_license_no'    =>  'nullable|string|min:6|max:15',
                'driving_license_class' =>  'nullable|string|max:9',
                'comment'               =>  'nullable|string|max:1000'
        ]);

        $customer->update($request->all());

        $customer = $customer->only([
            'id',
            'name1',
            'name2',
            'plz',
            'city',
        ]);

        return response()->json($customer,
            Response::HTTP_OK
        );
    }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        // Save the ID of the Customer to be deleted
        $id = $customer->id;

        $customer->delete();

        // include the id in the Response, so the Frontend can update its list.
        return response()->json($id, Response::HTTP_OK);

    }
}
