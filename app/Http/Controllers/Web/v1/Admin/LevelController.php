<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\Controller;
use App\Services\v1\FileService;
use App\Services\v1\LevelService;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\LevelControllerRequests\LevelStoreAndUpdateRequest;
use App\Models\Profiles\Level;
use App\Utils\StaticConstants;
use Illuminate\Support\Facades\DB;
use App\Exceptions\WebServiceErroredException;
use Session;

class LevelController extends WebBaseController
{
    protected $levelService;
    protected $fileService;
    public function __construct(LevelService $levelService, FileService $fileService)
    {
        $this->levelService = $levelService;
        $this->fileService = $fileService;
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

    public function store(LevelStoreAndUpdateRequest $request)
    {

        DB::beginTransaction();
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('logo')) {
            $path = $this->fileService->store($request->file('logo'), Level::DEFAULT_RESOURCE_DIRECTORY);
        }
        try {
            Level::create([
                'logo' => $path,
                'discount_percentage' => $request->discount_percentage,
                'start_count' => $request->start_count,
                'end_count' => $request->end_count,
                'name' => $request->name,
                'description' => $request->description,
                'period_date' => $request->period_date,
            ]);
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

    public function update(LevelStoreAndUpdateRequest $request, $id)
    {
        $level = Level::findOrFail($id);
        $path = $level->logo;
        if ($request->file('logo')) {
            $path = $this->fileService->updateWithRemoveOrStore($request->file('logo'),
                Level::DEFAULT_RESOURCE_DIRECTORY, $path);
        }
            $level->update([
                'logo' => $path,
                'discount_percentage' => $request->discount_percentage,
                'start_count' => $request->start_count,
                'end_count' => $request->end_count,
                'name' => $request->name,
                'description' => $request->description,
                'period_date' => $request->period_date]);
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
