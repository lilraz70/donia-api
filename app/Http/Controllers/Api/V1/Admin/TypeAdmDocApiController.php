<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeAdmDocRequest;
use App\Http\Requests\UpdateTypeAdmDocRequest;
use App\Http\Resources\Admin\TypeAdmDocResource;
use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeAdmDocApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_adm_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeAdmDocResource(TypeAdmDoc::all());
    }

    public function store(StoreTypeAdmDocRequest $request)
    {
        $typeAdmDoc = TypeAdmDoc::create($request->all());

        return (new TypeAdmDocResource($typeAdmDoc))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeAdmDoc $typeAdmDoc)
    {
        abort_if(Gate::denies('type_adm_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeAdmDocResource($typeAdmDoc);
    }

    public function update(UpdateTypeAdmDocRequest $request, TypeAdmDoc $typeAdmDoc)
    {
        $typeAdmDoc->update($request->all());

        return (new TypeAdmDocResource($typeAdmDoc))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeAdmDoc $typeAdmDoc)
    {
        abort_if(Gate::denies('type_adm_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeAdmDoc->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
