<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        if ($request->input('profil', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profil'))))->toMediaCollection('profil');
        }

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        //abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    /* public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
         if ($request->input('profil', false)) {
            if (!$user->profil || $request->input('profil') !== $user->profil->file_name) {
                if ($user->profil) {
                    $user->profil->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('profil'))))->toMediaCollection('profil');
            }
        } elseif ($user->profil) {
            $user->profil->delete();
        }

         return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);


    } */

    public function update(UpdateUserRequest $request, User $user)
        {
            $user->update($request->all());

             return (new UserResource($user))->response();



        }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

      public function search(Request $request)
         {
             //var_dump($request->all());
             $input=$request->all();
             $user_access=$input["user_access"];

             $user = User::whereEmail($user_access)->orWhere('phone', $user_access)->get();

             return response()->json($user);

         }
}
