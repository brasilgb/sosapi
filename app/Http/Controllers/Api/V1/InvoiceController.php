<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use App\Models\User;
use App\Traits\HttpResponses;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    use HttpResponses;

    // public function __construct()
    // {
    //     $this->middleware(['auth:sanctum', 'ability:user-store,user-update'])->only(['store', 'update']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('users')->get();
        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if(!auth()->user()->tokenCan('user-store')) {
        //     return $this->error('Unauthorized', 403);
        // }
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|max:1',
            'paid' => 'required|numeric|between:0,1',
            'payment_date' => 'nullable',
            'value' => 'required|numeric|between:1,9999,99'
        ]);
        if ($validator->fails()) {
            return $this->error('Data invalid', 422, $validator->errors());
        }

        $created = Invoice::create($validator->validated());

        if ($created) {
            return $this->response('Invoice created!', 200, new InvoiceResource($created->load('user')));
        }
        return $this->error('Invoice not create!d', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // $users = User::findOrFail($user);
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required|max:1|in:' . implode(',',['B','C','P']),
            'paid' => 'required|numeric|between:0,1',
            'value' => 'required|numeric',
            'payment_date' => 'nullable|date_format:Y-m-d H:i:s'
        ]);
        if ($validator->fails()) {
            return $this->error('Data invalid', 422, $validator->errors());
        }
        $validated = $validator->validated();
        $updated = $invoice->update([
            'user_id' => $validated['user_id'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'value' => $validated['value'],
            'payment_date' => $validated['paid'] ? $validated['payment_date'] : null
        ]);

        if ($updated) {
            return $this->response('Invoice updated!', 200, new InvoiceResource($invoice->load('user')));
        }
        return $this->error('Invoice not updated!', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $deleted = $invoice->delete();

        if($deleted) {
            return $this->response('Invoice deleted!', 200);
        }
        return $this->response('Invoice not deleted!', 400);
    }
}
