<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\V1\Admin\BaseController as AdminBaseController;

class UserController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = User::orderBy( "name" , "desc" )->get();
        return $this->sendResponse($data, "La liste des utilisateurs");
        } catch (\Throwable $th) {
          return $this->sendError("Erreur de recupération de la liste des utilisateurs", $th);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
   {
    $messages = [
        'telephone.required' => 'Le numéro de téléphone est obligatoire',
        'telephone.unique' => "Ce numéro de téléphone est déjà associé à un compte"
    ];

    try {
        $data = $request->validate([
            'name' => 'nullable|string',
            "pseudo" => "nullable",
            "telephone" => "required|string|unique:users",
            "photo_de_profil" => 'nullable',
            "google_id" => "nullable|unique:users",
            "facebook_id" => "nullable|unique:users"
        ], $messages);

        if ($request["photo_de_profil"]) {
            $path =  $request->file('photo_de_profil')->store('images');
            $data["photo_de_profil"] = $path;
        }
        $user = User::create($data);
        $user->roles()->attach(2);
        $user["token"] = $user->createToken('register_token')->plainTextToken;
        return $this->sendResponse($user, "Utilisateur crée avec succès");
    } catch (ValidationException $e) {
        return $this->sendError("La création de l'utilisateur a échoué", $e->errors(),);
    } catch (\Throwable $th) {
       // logger()->error($th);
        return $this->sendError("Une erreur s'est produite lors de la création de l'utilisateur", $th,);
    }

   }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = User::where('id', $id)->first();
            if($data){
                return $this->sendResponse($data, "Les informations de l'utilisateur");
            }else{
                return $this->sendError("La récupération a echouée, l'utilisateur n'existe pas");
            }
        } catch (\Throwable $th) {
            return $this->sendError("Erreur de récupération des informations de l'utilisateur", $th);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
        $request->validate([
            'name'=>'nullable|string',
            "pseudo"=>"nullable",
            "telephone"=>"nullable|string",
        ]);
        $attrs = $request->all();
            $user = User::find($id);

            if($user){
            
                $user->update($attrs);
                return $this->sendResponse($user, "La mise à jour de l'utilisateur à reussi");
            }else{
                return $this->sendError("Mise à jour non reussi, l'utilisateur n'existe pas");
            }
        } catch (ValidationException $e) {
            return $this->sendError("La modification de l'utilisateur a échoué", $e->errors(),);
        } catch (\Throwable $th) {
           // logger()->error($th);
            return $this->sendError("Une erreur s'est produite lors de la modification, de l'utilisateur", $th,);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = User::Find($id);
            if($data){
                if($data->photo_de_profil){
                    Storage::delete('public/images',$data->photo_de_profil);
                }
                User::destroy($id);
                return $this->sendResponse($data, "Utilisateur supprimé");
            }else{
                return $this->sendError("La suppression à echouée, l'utilisateur n'exist pas");
            }
        } catch (\Throwable $th) {
            return $this->sendError("La suppression de l'utilisateur a echoué", $th);
        }
    }
    public function loginByPhone(Request $request)
    {
        $messages = [
            'telephone.required' => 'Le numéro de téléphone est obligatoire',
        ];
        try {
        $attrs = $request->validate([
            'telephone'=>'required|string',
        ], $messages);

            $user = User::where("telephone", $attrs["telephone"])->first();
        if($user){
           $user['token'] = $user ->createToken('login_token')->plainTextToken;
           return $this->sendResponse($user, "Connexion reussie");
        }else{
            return $this->sendError("Utilisateur introuvable",[],);
        }
    } catch (ValidationException $e) {
        return $this->sendError("L'authentification a echouée", $e->errors(),);
    } catch (\Throwable $th) {
       // logger()->error($th);
        return $this->sendError("Une erreur s'est produite lors de l'authentification ", $th,);
    }


    }
    public function loginByGoogle(Request $request)
    {

        $messages = [
            'google_id.required' => 'le googleId est obligatoire',
        ];
        try{
        $attrs = $request->validate([
            'google_id'=>'required',
        ], $messages);
            $user = User::where("google_id", $attrs['google_id'])->first();
        if($user){

            $user['token'] = $user ->createToken('login_token')->plainTextToken;
           return $this->sendResponse($user, "Connexion reussi");
        }else {
            return $this->sendError("Utilisateur introuvable");
        }
    } catch (ValidationException $e) {
        return $this->sendError("L'authentification a echouée", $e->errors(),);
    } catch (\Throwable $th) {
       // logger()->error($th);
        return $this->sendError("Une erreur s'est produite lors de l'authentification ", $th,);
    }

    }

    public function loginByFacebook(Request $request)
    {
        $messages = [
            'facebook_id.required' => 'le facebookId est obligatoire',

        ];
        try{
        $attrs = $request->validate([
            'facebook_id'=>'required',
        ], $messages);

            $user = User::where("facebook_id", $attrs['facebook_id'])->first();
        if($user){

           $user['token'] = $user ->createToken('login_token')->plainTextToken;
           return $this->sendResponse($user, "Connexion reussi");
        }else {
            return $this->sendError("Utilisateur introuvable",[],);
        }
    } catch (ValidationException $e) {
        return $this->sendError("L'authentification a echouée", $e->errors(),);
    } catch (\Throwable $th) {
       // logger()->error($th);
        return $this->sendError("Une erreur s'est produite lors de l'authentification ", $th,);
    }

    }

    public function logout(request $request){
        try{
            Auth::User()->tokens()->delete();
            return $this->sendInfo("Déconnexion reussi");
        }catch(\Throwable $th){
            return $this->sendError("Déconnexion non reussi", $th);
        }
    }
    public function changeProfilPicture(Request $request,$id){
        $messages = [
            'photo_de_profil.required' => 'le photo de profil est obligatoire',

        ];
        try {
      $attrs =  $request->validate([
            'photo_de_profil'=>"required"
        ]);

           $user = User::find($id);

           if($user){
            if($user->photo_de_profil){
                Storage::delete('public/images',$user->photo_de_profil);
            }
            if($request["photo_de_profil"]){
                $path = $request->file('photo_de_profil')->store('images');
                $attrs["photo_de_profil"] = $path;
            }
             $user->update([
                "photo_de_profil"=> $attrs["photo_de_profil"]
            ]);
            $user = User::find($id);
          return  $this->sendResponse($user,"Photo de profil mise à jour avec succès");
           }
        } catch (ValidationException $e) {
            return $this->sendError("La modificiation a echouée", $e->errors(),);
        } catch (\Throwable $th) {
           // logger()->error($th);
            return $this->sendError("Une erreur s'est produite lors de la modification ", $th,);
        }
    }

}
