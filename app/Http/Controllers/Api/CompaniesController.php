<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use App\Models\Address;
use App\Models\Company;
use App\Services\Company\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompaniesController extends Controller
{

    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $companies = Company::with('address')->get();
        $labels = $this->companyService->getLabels();

        return response()->json([
            'labels' => $labels,
            'data' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyCreateRequest $request
     * @return JsonResponse
     */
    public function store(CompanyCreateRequest $request)
    {
        try {
            $address = Address::create($request->get('address'));
            $company = $address->company()->create($request->get('company'));

            return request()->json([
                'message' => 'Success'
            ], 200);
        } catch (\Exception $e) {
            return \response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyUpdateRequest $request
     * @return JsonResponse
     */
    public function update(CompanyUpdateRequest $request)
    {
        //TODO: clean this up
        $data = $request->all();

        $company = Company::find($data['company']['id']);
        $address = Address::find($data['company']['address_id']);

        $company->update($data['company']);
        $address->update($data['address']);

        return response()->json([
            'message' => 'Success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return response()->json([
            'message' => 'Success'
        ], 200);
    }
}
