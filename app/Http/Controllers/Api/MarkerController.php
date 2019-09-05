<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Marker\StoreRequest;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\MarkerResourceCollection;
use App\Models\Marker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MarkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $bbox = $request->get('bbox');

        if ($bbox) {
            $markers = new MarkerResourceCollection(Marker::inBoundedBox($bbox)->get());
            return response()->json($markers);
        } else {
            return response()->json([
                'success' => false,
                'message'     => "No bound box coordinates",
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $marker = Marker::create([
            'comment'     => $request->post('comment'),
            'coordinates' => DB::raw("POINT({$request->post('longitude')}, {$request->post('latitude')})")
        ]);

        $marker->types()->attach($request->post('types'));

        $marker = Marker::with(['types'])
            ->selectRaw('id, comment, ST_AsGeoJSON(coordinates) as geometry, created_at')
            ->whereId($marker->id)
            ->first();

        return response()->json([
            'success' => true,
            'message'     => "Marker saved",
            'feature' => new FeatureResource($marker)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
