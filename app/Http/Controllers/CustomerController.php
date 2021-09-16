<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        // if(Gate::allows("view", Customer::class))
        // {
            return Customer::select('id', 'name1', 'name2', 'city', 'plz')->orderBy('name1')->get();
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (Gate::allows("create", Customer::class)) {
            // Hole den genannten Kunden aus der Datenbank.
            //$customer = Customer::findOrFail($customer);

            // Validiere den Input
            $this->validate($request, [
                'pass_number'           =>  'nullable|string|min:8|max:30',
                'name1'                 =>  'required|string|max:50',
                'name2'                 =>  'nullable|string|max:50',
                'street'                =>  'nullable|string|min:3|max:50',
                'plz'                   =>  'nullable|digits_between:4,5',
                'city'                  =>  'nullable|string|min:3|max:50',
                'birth_date'            =>  'nullable',
                'birth_city'            =>  'nullable|string|min:3|max:50',
                'phone'                 =>  'nullable|string|min:6|max:15',
                'car_number'            =>  'nullable|string|min:5|max:20',
                'email'                 =>  'nullable|email',
                'driving_license_no'    =>  'nullable|string|min:6|max:15',
                'driving_license_class' =>  'nullable|string|max:9',
                'customer_type'         =>  'nullable|string|min:3|max:10',

            ]);

            Customer::create($request->all());

            return true;
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
                'driving_license_class'
            ]);
        return response()->json($customer);
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
        // if (Gate::allows("update", Customer::class)) {
            // Hole den genannten Kunden aus der Datenbank.
            //$customer = Customer::findOrFail($customer);

            // Validiere den Input
            $this->validate($request, [
                'pass_number'           =>  'nullable|string|min:8|max:30',
                'name1'                 =>  'required|string|max:50',
                'name2'                 =>  'nullable|string|max:50',
                'street'                =>  'nullable|string|min:3|max:50',
                'plz'                   =>  'nullable|digits_between:4,5',
                'city'                  =>  'nullable|string|min:3|max:50',
                'birth_date'            =>  'nullable',
                'birth_city'            =>  'nullable|string|min:3|max:50',
                'phone'                 =>  'nullable|string|min:6|max:15',
                'car_number'            =>  'nullable|string|min:5|max:20',
                'email'                 =>  'nullable|email',
                'driving_license_no'    =>  'nullable|string|min:6|max:15',
                'driving_license_class' =>  'nullable|string|max:9',
                'customer_type'         =>  'nullable|string|min:3|max:10',

            ]);

            $customer->update($request->all());

            return true;
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
        // if (Gate::allows("destroy", Customer::class)) {
            $customer->delete();

            return true;
        // }
    }
}
