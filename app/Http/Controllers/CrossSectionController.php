<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrossSectionRequest;
use App\Models\CrossSection;
use App\Models\Point;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CrossSectionController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index():View
    {
        $cross_sections = CrossSection::orderBy('created_at')->get();
        return view('cross-sections.index',[
            'cross_sections' => $cross_sections,
        ]);
    }

    public function create():View
    {
        return View('cross-sections.create');
    }


    /**
     * Stores cross-section given by request.
     *
     * @param CrossSectionRequest $request
     *
     * @return JsonResponse|Redirector
     */
    public function store(CrossSectionRequest $request)
    {
        try {
            $attributes = $request->validated();

            $crossSection = CrossSection::create($attributes);

            foreach ($request['point'] as $point) {
                error_log("Request[point]: [" . $point['x'] . " , " . $point['y'] . " ]");
                Point::create([
                    'cross_section_id' => $crossSection->id,
                    'x' => $point['x'],
                    'y' => $point['y'],
                ]);
            }

            /*return response()->json([
                'status' => 'ok',
                'message' => 'cross-section added successfully',
            ])->setStatusCode('200');*/

            return redirect(route('cross_sections.index'));

        } catch(\Exception $e) {

            return response()->json([
                'status' => 'fail',
                'message' => 'an error occured during adding cross-section',
                'error' => $e->getMessage(),
            ])->setStatusCode('500');
        }
    }

    /**
     * method updates cross-section entry
     * @param CrossSectionRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|JsonResponse|RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CrossSectionRequest $request, int $id)
    {
        $crossSection = CrossSection::find($id);
        error_log("crossSection: ".$crossSection);
        try{
            $attributes = $request->validated();

            //$crossSection = CrossSection::find($id);

            foreach($crossSection->points as $point){
                $point->delete();
            }

            $crossSection->update($attributes);

            foreach ($request['point'] as $point) {
                error_log("Request[point]: [" . $point['x'] . " , " . $point['y'] . " ]");
                Point::create([
                    'cross_section_id' => $crossSection->id,
                    'x' => $point['x'],
                    'y' => $point['y'],
                ]);
            }

            return redirect(route('cross_sections.index'));

            /*return response()->json([
                'status' => 'ok',
                'message' => 'cross-section updated successfully',
            ])->setStatusCode('200');*/

        }catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'an error occured during updating cross-section',
                'error' => $e->getMessage(),
            ])->setStatusCode('500');
        }
    }

    public function destroy($id):JsonResponse
    {
        try{
            $cross_section = CrossSection::find($id);

            foreach($cross_section->points as $point){
                $point->delete();
            }
            $cross_section->delete();
            return response()->json([
                'status' => 'ok',
                'message' => 'cross-section deleted successfully',
            ])->setStatusCode('200');
        } catch(\Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'an error occurred while deleting cross-section',
            ])->setStatusCode('500');
        }
    }

    public function edit($id):view
    {
        $crossSection = CrossSection::find($id);

        return view('cross-sections.edit',[
            'crossSection' => $crossSection,
        ]);
    }

    public function dwgExport($id){
        try {
            $crossSection = CrossSection::find($id);

            $downloadLink = $crossSection->drawCad();

            return response()->json([
                'title' => 'Success',
                'message' => 'cross section successfully exported to script file',
                'download' => $downloadLink,
            ])->setStatusCode(200);

        } catch (\Exception $e){
            Log::error("CrossSectionController@dwgExport error:".$e->getMessage());
            return response()->json([
                'title' => 'Fail',
                'message' => 'Some error occurred while exporting your cross section',
            ])->setStatusCode(500);
        }
    }

}
