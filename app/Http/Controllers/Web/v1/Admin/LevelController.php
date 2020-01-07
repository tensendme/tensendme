<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\Controller;
use App\Services\v1\LevelService;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\LevelControllerRequests\StoreAndUpdateRequest;
use App\Models\Profiles\Level;
use Illuminate\Support\Facades\DB;
use App\Exceptions\WebServiceErroredException;
use Session;

class LevelController extends WebBaseController
{
    protected $levelService;
    public function __construct(LevelService $levelService)
    {
        $this->levelService = $levelService;
    }

    public function index()
    {
        $levels = Level::all();

        return view('admin.level.index',compact('levels'));
    }

    public function create()
    {

        $level = new Level();

        return view('admin.level.create', compact('level'));
    }

    public function store(StoreAndUpdateRequest $request)
    {

        DB::beginTransaction();
        try {
            Level::create($request->all());
            DB::commit();
            $this->added();
            return redirect()->route('level.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . $exception->getMessage());
        }
    }

    public function edit($id)
    {

        $level = Level::findOrFail($id);

        return view('admin.level.edit', compact('level'));

    }

    public function update(StoreAndUpdateRequest $request, $id)
    {
        Level::findOrFail($id)
            ->update($request->all());
        $this->edited();
        return redirect()->route('level.index');

    }

    public function destroy($id)
    {
        Level::destroy($id);

        $this->deleted();

        return redirect()->route('level.index');
    }
}
