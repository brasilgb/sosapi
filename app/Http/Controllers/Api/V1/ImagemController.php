<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ImagemResource;
use App\Models\Imagem;
use App\Models\Ordem;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class ImagemController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->ordem;

        $imagem = Imagem::where("ordem_id", $query)->get();

        return ImagemResource::collection($imagem);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storePath = public_path('storage/ordens/' . $request->ordem_id);
        if (!file_exists($storePath)) {
            mkdir($storePath, 0777, true);
        };
        if ($request->imagem) {
            foreach ($request->imagem as $file) {
                $filename = time() . rand(1, 50) . '.' . $file->extension();
                $file->move($storePath, $filename);

                $created = Imagem::create([
                    'ordem_id' => $request->ordem_id,
                    'imagem' => $filename
                ]);
            }
        }

        if ($created) {
            return $this->response('Imagens cadastradas com sucesso!', 200, new ImagemResource($created));
        }
        return $this->error('Imagens não cadastradas', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Imagem $imagem)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imagem $imagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imagem $imagem)
    {
        // dd($imagem);
        $storePath = public_path('storage/ordens/' . $imagem->ordem_id);
        if (file_exists($storePath . DIRECTORY_SEPARATOR . $imagem->imagem)) {
            unlink($storePath . DIRECTORY_SEPARATOR . $imagem->imagem);
        }
        $deleted = $imagem->delete();

        if ($deleted) {
            return $this->response('Imagem deletada com sucesso!', 200);
        }
        return $this->response('Imagem não deletada!', 400);
    }
}
/*
        $storePath = public_path('storage/ordens/' . $request->ordem_id);
        if (file_exists($storePath . DIRECTORY_SEPARATOR . $image->image)) {
            unlink($storePath . DIRECTORY_SEPARATOR . $image->image);
        }
        $image->galleries()->detach();
        $image->delete($image);
        Session::flash('success', 'Imagem deletada com sucesso!');
        return redirect()->route('images.index');

*/