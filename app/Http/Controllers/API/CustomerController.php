<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class CustomerController extends Controller
{
    public function index(): DataTableCollectionResource
    {
        $length      = request( 'length' );
        $orderBy     = request( 'column' );
        $orderByDir  = request( 'dir', 'asc' );
        $searchValue = request( 'search' );

        $customer = Customer::query();

        if ( $searchValue ) {
            $customer->where( 'email', 'LIKE', "%{$searchValue}%" )
                     ->orWhere( 'phone_number', 'LIKE', "%{$searchValue}%" )
                     ->orWhere( 'first_name', 'LIKE', "%{$searchValue}%" )
                     ->orWhere( 'last_name', 'LIKE', "%{$searchValue}%" );
        }

        $data = $customer->orderBy( $orderBy, $orderByDir )->paginate( $length );

        return new DataTableCollectionResource( $data );
    }

    public function store(): JsonResponse
    {
        try {
            $rules = [
                'email'        => 'required|email',
                'phone_number' => 'required|numeric',
                'first_name'   => 'required|max:255',
                'last_name'    => 'required|max:255',
            ];

            $validator = Validator::make( request()->all(), $rules );

            if ( $validator->fails() ) {
                return response()->json( [ 'errors' => $validator->errors() ], 422 );
            }

            Customer::create( array_intersect_key( request()->all(), $rules ) );

            return response()->json( [
                'message' => 'Customer created',
            ] );
        }
        catch ( \Exception $e ) {
            Log::error( $e->getMessage() );

            return response()->json( [
                'errors' => 'Something went wrong',
            ], 500 );
        }
    }

    public function edit( $id )
    {
        return Customer::find( $id );
    }

    public function update( $id ): JsonResponse
    {
        try {
            $rules = [
                'email'        => 'required|email',
                'phone_number' => 'required|numeric',
                'first_name'   => 'required|max:255',
                'last_name'    => 'required|max:255',
            ];

            $validator = Validator::make( request()->all(), $rules );

            if ( $validator->fails() ) {
                return response()->json( [ 'errors' => $validator->errors() ], 422 );
            }

            Customer::find( $id )->update( array_intersect_key( request()->all(), $rules ) );

            return response()->json( [
                'message' => 'Customer updated',
            ] );
        }
        catch ( \Exception $e ) {
            Log::error( $e->getMessage() );

            return response()->json( [
                'errors' => 'Something went wrong',
            ], 500 );
        }
    }

    public function delete( $id ): JsonResponse
    {
        try {
            Customer::find( $id )->delete();

            return response()->json( [
                'message' => 'Customer deleted',
            ] );
        }
        catch ( \Exception $e ) {
            Log::error( $e->getMessage() );

            return response()->json( [
                'errors' => 'Something went wrong',
            ], 500 );
        }
    }

    public function upload(): JsonResponse
    {
        try {
            ( new CustomerImport() )->import( request( 'file' ), null, \Maatwebsite\Excel\Excel::CSV );

            return response()->json( [
                'message' => 'Customers list uploaded',
            ] );
        }
        catch ( \Exception $e ) {
            Log::error( $e->getMessage() );

            return response()->json( [
                'errors' => 'Something went wrong',
            ], 500 );
        }
    }
}
