<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Models\Besoin;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBesoinRequest;
use App\Http\Requests\UpdateBesoinRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\V1\Admin\BaseController as AdminBaseController;

class BesoinController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $besoins = Besoin::with('user')->orderBy("created_at", 'desc')->paginate(10);

        return $this->sendResponse($besoins, "la liste des besoins");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBesoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {
    $messages = [
        'description.required' => 'La,description est obligatoire',
        'titre.required' => 'Le titre est obligatoire',
        'userId.unique' => "l'utilisateur est obligatoire"
    ];

    try {
         $request->validate([
            "userId" => "required",
            "description" => "required",
            "titre" => "required"
        ], $messages);
        $user = User::find($request->userId);
        if($user){
            $request['user_id'] =  $user->id;
           $besoin =  Besoin::create($request->all());
        }
        return $this->sendResponse($besoin, "Besoin crée avec succès");
    } catch (ValidationException $e) {
        return $this->sendError("La création à echoué", $e->errors(),);
    } catch (\Throwable $th) {
       // logger()->error($th);
        return $this->sendError("Une erreur s'est produite lors de la création ", $th->getMessage(),);
    }

   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Besoin  $besoin
     * @return \Illuminate\Http\Response
     */
    public function show(Besoin $besoin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Besoin  $besoin
     * @return \Illuminate\Http\Response
     */
    public function edit(Besoin $besoin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBesoinRequest  $request
     * @param  \App\Models\Besoin  $besoin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'description.required' => 'La description est obligatoire',
            'titre.required' => 'Le titre est obligatoire',
        ];

        try {
             $request->validate([
                "description" => "required",
                "titre" => "required"
            ], $messages);
            $attrs = $request->all() ;
            $besoin = Besoin::find($id);
            $besoin->update($attrs);
            return $this->sendResponse($besoin, "Besoin modifier avec succès");
        } catch (ValidationException $e) {
            return $this->sendError("La modification à echoué", $e->errors(),);
        } catch (\Throwable $th) {
            return $this->sendError("Une erreur s'est produite lors de la modification ", $th->getMessage(),);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Besoin  $besoin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         try {
            $data = Besoin::Find($id);
            if($data){
                Besoin::destroy($id);
                return $this->sendResponse($data, "le besoin est supprimée");
            }else{
                return $this->sendError("La suppression à echouée, le besoin n'exist pas");
            }

        } catch (\Throwable $th) {
            return $this->sendError("La suppression du besoin a echouée", $th->getMessage());
        }
    }

    public function userBesoin($id){

        try {
          $user = User::find($id);
          if($user){
           // $besoins = $user->besoins::with('user')->orderBy("created_at", 'desc')->paginate(10);
           $besoins = Besoin::with('user')->where("user_id", $user->id)->orderBy("created_at", 'desc')->paginate(10);
            return $this->sendResponse($besoins, "la liste des besoins de l'utilisateur");
          }else {
            return $this->sendError("l'utilisateur n'existe pas",);
          }
        } catch (\Throwable $th) {
           return $this->sendError("Une erreur s'est produite lors de la récupéation des besoins ", $th->getMessage(),);
        }

    }

}
