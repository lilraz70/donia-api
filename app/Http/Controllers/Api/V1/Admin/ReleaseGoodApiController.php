<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\ReleaseGood;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\ReleaseGoodConvenience;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreReleaseGoodRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\UpdateReleaseGoodRequest;
use App\Http\Resources\Admin\ReleaseGoodResource;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReleaseGoodApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('release_good_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //return new ReleaseGoodResource(ReleaseGood::whereVerifAccordBailleur('1')->with(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel', 'releasegoodconvenience'])->get());
        return new ReleaseGoodResource(ReleaseGood::whereAccordBailleur('1')
            ->with(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel', 'releasegoodconvenience', 'images'])->orderBy('date_sorti_prevu', 'desc')->orderBy('cout', 'desc')->get());
        //return new ReleaseGoodResource(ReleaseGood::where('VerifAccordBailleur', '=', 1)->with(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel', 'releasegoodconvenience'])->get());

    }

    //StoreReleaseGoodRequest

    public function store(StoreReleaseGoodRequest $request)
    {
        //return response($request->all(), 201);

        /* DB::transaction(function()
{ */
        $inputs = $request->all();
        //traitement des inputs

        $date_sorti_prevu = $inputs['date_sorti_prevu'];
        $commentaires = $inputs['commentaires'];
        $setcountry_id = intval($inputs['setcountry_id']);
        $city_id = intval($inputs['city_id']);
        $quartier_id = intval($inputs['quartier_id']);
        $nb_chambre = intval($inputs['nb_chambre']);
        $cout = intval($inputs['cout']);
        //$accordBailleur=intval($inputs['accordBailleur']);
        $emergencylevel_id = intval($inputs['emergencylevel_id']);
        $propertytype_id = intval($inputs['propertytype_id']);

        //recherche du user

        $user_access = $inputs['user_access'];
        $user_id = User::whereEmail($user_access)->orWhere('telephone', $user_access)->first()->id;

        //$conveniencetype_ids=$inputs['conveniencetype_ids'];

        //var_dump($inputs);



        //creer le libele
        $type_bien = strtoupper(PropertyType::whereId($propertytype_id)->first()->intitule);
        $count_releasegood = ReleaseGood::all()->count();
        $date = now();
        $ladate = $date->format('dmy');
        $randomer = $this->generateRandomString();
        $libelle = $type_bien . $count_releasegood . $ladate . $randomer;

        //           print($date_sorti_prevu);
        //return response($conveniencetype_ids_liste[0], 201);


        try {
            $input = $request->all();
            if ($request["image_url"]) {
                $path = $request->file('image_url')->store('images');
                $input["image_url"] = $path;
            }
            $releaseGood =  ReleaseGood::create($input);
            if ($request["other_image"]) {
                foreach ($request["other_image"] as $image) {
                    $path = Storage::put('images', $image['image_url']);
                    $releaseGood->images()->create([
                        'image_url' => $path
                    ]);
                }
            }

            if ($inputs['loyer_augmentera'] == 'true') {
                $releaseGood->loyer_augmentera = 1;
            } else {
                $releaseGood->loyer_augmentera = 0;
            }

            $releaseGood->user_id = $user_id;
            $releaseGood->date_sorti_prevu = $date_sorti_prevu;
            $releaseGood->setcountry_id = $setcountry_id;
            $releaseGood->quartier_id = $quartier_id;
            $releaseGood->nb_chambre = $nb_chambre;
            $releaseGood->cout = $cout;
            $releaseGood->city_id = $city_id;
            $releaseGood->emergencylevel_id = $emergencylevel_id;
            $releaseGood->propertytype_id = $propertytype_id;
            $releaseGood->libelle = $libelle;
            $releaseGood->accord_bailleur = true;
            $releaseGood->save();

            //print($releaseGood->date_sorti_prevu);

            //ajout des commodités

            $conveniencetype_ids = $inputs['conveniencetype_ids'];
            $conveniencetype_nb = $inputs['conveniencetype_nb'];

            $conveniencetype_ids_liste = explode(',', $conveniencetype_ids);
            $conveniencetype_nb_liste = explode(',', $conveniencetype_nb);

            //var_dump($conveniencetype_nb_liste);

            for ($i = 0; $i < count($conveniencetype_ids_liste); $i++) {
                $conveniencetype = new ReleaseGoodConvenience();
                $conveniencetype->releasegood_id = $releaseGood->id;
                $conveniencetype->conveniencetype_id = intval($conveniencetype_ids_liste[$i]);
                $conveniencetype->number = intval($conveniencetype_nb_liste[$i]);

                $conveniencetype->save();
            }
            /*  foreach ($conveniencetype_ids_liste as $value) {



                $conveniencetype = new ReleaseGoodConvenience();
                $conveniencetype->releasegood_id=$releaseGood->id;
                $conveniencetype->conveniencetype_id=intval($value);

                $conveniencetype->save();

            } */


            return (new ReleaseGoodResource($releaseGood))->response();
        } catch (\Exception $e) {

            return $e;
        }
    }



    public function show(ReleaseGood $releaseGood)
    {
        //abort_if(Gate::denies('release_good_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReleaseGoodResource($releaseGood->load(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel']));
    }


    public function update(UpdateReleaseGoodRequest $request, ReleaseGood $releaseGood)
    {

        try {

            if ($request['delete_image_id']) {
                if (is_array($request['delete_image_id'])) {
                    $image_ids = $request['delete_image_id'];
                } else {
                    $image_ids = explode(',', $request['delete_image_id']);
                }
                foreach ($image_ids as $image_id) {
                    $image = Image::find($image_id);
                    if ($image) {
                        Storage::delete($image->image_url);
                        $image->delete();
                    }
                }
            }
            $releaseGood->update($request->all());
            //ajout des commodités
            $conveniencetype_ids = $request['conveniencetype_ids'];
            $conveniencetype_nb = $request['conveniencetype_nb'];

            $conveniencetype_ids_liste = explode(',', $conveniencetype_ids);
            $conveniencetype_nb_liste = explode(',', $conveniencetype_nb);

            //var_dump($conveniencetype_nb_liste);


            if (count($conveniencetype_ids_liste) > 0) {
                for ($i = 0; $i < count($conveniencetype_ids_liste); $i++) {
                    $conveniencetype = new ReleaseGoodConvenience();
                    $conveniencetype->releasegood_id = $releaseGood->id;
                    $conveniencetype->conveniencetype_id = intval($conveniencetype_ids_liste[$i]);
                    $conveniencetype->number = intval($conveniencetype_nb_liste[$i]);


                    $conveniencetype->save();
                }
            }


        /*    return (new ReleaseGoodResource($releaseGood))
                ->response();*/
         return  response()->json([
                    'success'=> true,
                    'message' => 'Bien modifié avec succès',
                ], 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy(ReleaseGood $releaseGood)
    {
        abort_if(Gate::denies('release_good_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGood->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function generateRandomString($length = 3)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function search(Request $request, $user_id)
    {
        //  $releaseGoods = ReleaseGood::where('user_id', '=', $user_id)->with(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel', 'releasegoodconvenience', 'images'])->orderBy('date_sorti_prevu','desc')->orderBy('cout', 'desc')->get();
        //return response($quartiers, Response::HTTP_ACCEPTED);
        //  return response($releaseGoods);
        abort_if(Gate::denies('release_good_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return new ReleaseGoodResource(ReleaseGood::whereUserId($user_id)
            ->with(['propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel', 'releasegoodconvenience', 'images'])->orderBy('date_sorti_prevu', 'desc')->orderBy('cout', 'desc')->get());
    }

    public function destroyRelease($id)
    {
        abort_if(Gate::denies('release_good_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $releaseGood = ReleaseGood::find($id);
        if ($releaseGood) {
            if ($releaseGood->image_url) {
                Storage::delete($releaseGood->image_url);
            }
            if ($releaseGood->images) {
                foreach ($releaseGood->images as $image) {
                    Storage::delete($image->image_url);
                    $image->delete();
                }
            }
            $releaseGood->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'supprimer avec succèss',
            ], 200);
        } else {
            return   response()->json([
                'success'   => false,
                'message'   => 'impossible de supprimer',
            ], 400);
        }
    }

    public function uploadImage(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'images' => 'nullable|array',
            'image_url' => 'nullable',
        ]);
        try {
            $releaseGood = ReleaseGood::find($request->id);

            if ($releaseGood) {
                if ($request["image_url"]) {
                    $path = $request->file('image_url')->store('images');
                    $input["image_url"] = $path;
                    $releaseGood->update($input);
                    return response()->json([
                        'success'   => true,
                        'data' => $releaseGood,
                        'message'   => 'ajout avec succèss',
                    ], 200);
                }
                if ($request["images"]) {
                    foreach ($request["images"] as $image) {
                        $path = Storage::put('images', $image);
                        $releaseGood->images()->create([
                            'image_url' => $path
                        ]);
                    }
                    return response()->json([
                        'success'   => true,
                        'data' => $releaseGood->images,
                        'message'   => 'ajout avec succèss',
                    ], 200);
                }
            } else {
                return   response()->json([
                    'success'   => false,
                    'message'   => 'ajout echoué',
                ], 400);
            }
        } catch (\Throwable $th) {
            return   response()->json([
                'success'   => false,
                'message'   => 'Une erreur est survenue',
            ], 400);
        }
    }
}
