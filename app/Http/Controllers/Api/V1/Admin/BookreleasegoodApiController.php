<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookreleasegoodRequest;
use App\Http\Requests\UpdateBookreleasegoodRequest;
use App\Http\Resources\Admin\BookreleasegoodResource;
use App\Http\Resources\Admin\ReleaseGoodResource;
use App\Models\Bookreleasegood;
use App\Models\ReleaseGood;
use App\Models\ReleaseGoodConvenience;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookreleasegoodApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bookreleasegood_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookreleasegoodResource(Bookreleasegood::with(['releasegood', 'user'])->get());
    }

    public function store(StoreBookreleasegoodRequest $request)
    {
        //return response($request->all(), 201);

        $inputs=$request->all();
        //traitement des inputs
        $releasegood_id=intval($inputs['releasegood_id']);
        $user_access=$inputs['user_id'];

        //recherche du user


        $user_id= User::whereEmail($user_access)->orWhere('phone', $user_access)->first()->id;


        try{
            $bookreleaseGood = new Bookreleasegood();

            $bookreleaseGood->releasegood_id=$releasegood_id;
            $bookreleaseGood->user_id=$user_id;

            $bookreleaseGood->save();


            return (new BookreleasegoodResource($bookreleaseGood))
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);

        }
        catch(\Exception $e){
            // do task when error
           // echo $e->getMessage();   // insert query
            //return response()->setStatusCode(Response::HTTP_CREATED,'Une erreur est survenue!');
             return $e;
        }

        /*$bookreleasegood = Bookreleasegood::create($request->all());

        return (new BookreleasegoodResource($bookreleasegood))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);*/
    }

    public function show(Bookreleasegood $bookreleasegood)
    {
        abort_if(Gate::denies('bookreleasegood_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookreleasegoodResource($bookreleasegood->load(['releasegood', 'user']));
    }

    public function update(UpdateBookreleasegoodRequest $request, Bookreleasegood $bookreleasegood)
    {
        $bookreleasegood->update($request->all());

        return (new BookreleasegoodResource($bookreleasegood))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bookreleasegood $bookreleasegood)
    {
       // abort_if(Gate::denies('bookreleasegood_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookreleasegood->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /*  public function search(Request $request)
        {
            //var_dump($request->all());
            $input=$request->all();
            $userID=$input["user_id"];
            $releaseID=$input["releasegood_id"];

            $bookreleasegood = Bookreleasegood::whereUserId($userID)->whereReleasegoodId($releaseID)->get()->toJson();

            return response($bookreleasegood, Response::HTTP_ACCEPTED);

        } */
}
