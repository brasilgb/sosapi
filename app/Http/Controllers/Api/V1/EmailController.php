<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EmailResource;
use App\Models\Email;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Email::get()->isEmpty()) {
            Email::create();
        }
        $query = Email::orderBy("id", "DESC")->first();
        $email = Email::where("id", $query->id)->get();
        return EmailResource::collection($email);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Email $email)
    {

        $validator = Validator::make($request->all(), [
            'servidor' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error('Dados inválidos!', 422, $validator->errors());
        }

        $created = $email->update($request->all());

        if ($created) {
            return $this->response('E-mail alterada com sucesso!', 200, new EmailResource($email));
        }
        return $this->error('E-mail não alterada', 400);
    }

}
