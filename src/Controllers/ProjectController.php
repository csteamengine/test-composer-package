<?php

namespace Csteamengine\ProjectManager\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Image;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PHPColorExtractor\PHPColorExtractor;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * UserController constructor.
     *
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.projects.projects')->withProjects($this->projectRepository->getActivePaginated(25, 'order', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        return view('backend.projects.create')->with(['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(ProjectRequest $request)
    {
        $validated = $request->validated();

        $project = $this->projectRepository->create($request->only(
        'title',
            'description',
            'short_description',
            'medium',
            'date_started',
            'date_completed',
            'is_active'
        ));

        return redirect()->route('admin.projects.edit', $project->id)->withFlashSuccess('Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        if($project == null){
           return redirect()->route('admin.projects.index')->withFlashError('Project by that id does not exist');
        }

        $images = $project->images()->get();

        return view('backend.projects.edit')->with(['project'=>$project, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $project = $this->projectRepository->update($project, $request->only(
            'title',
            'description',
            'short_description',
            'medium',
            'date_started',
            'date_completed',
            'is_active'
        ));

        return redirect()->route('admin.projects.edit', $project->id)->withFlashSuccess('Project Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if($project->delete()){
            return redirect()->route('admin.projects.index')->withFlashSuccess('Project was successfully deleted!');
        }

        return redirect()->route('admin.projects.index')->withFlashError('Oops, something went wrong! Project was not deleted.');
    }

    public function addImages(Request $request, $id){

        $project = Project::find($id);

        if($project == null){
            return redirect()->route('admin.projects.index')->withFlashError('Project by that id does not exist');
        }


        foreach($request->file('newImageFile') as $file){
            $uploadDirectory = get_upload_directory();

            $file->store(config('filesystems.disks.public.upload_url').$uploadDirectory);

            $extractor = new PHPColorExtractor();
            $extractor->setImage($file->getPathname())->setTotalColors(5)->setGranularity(10);
            $palette = $extractor->extractPalette();
            $image_size = getimagesize($file->getPathname());
            $image_width = $image_size[0];
            $image_height = $image_size[1];

            $newImage = new Image([
                'title' => $file->getClientOriginalName(),
                'short_description' => '',
                'long_description' => '',
                'image_url' => config('filesystems.disks.public.access_url').$uploadDirectory.$file->hashName(),
                'image_type' => $file->getClientMimeType(),
//                'image_thumbnail' => '',
                'image_color' => $palette[sizeof($palette)-1],
                'image_height' => $image_height,
                'image_width' => $image_width,
                'is_active' => 1,
            ]);


            $insertedImage = $project->images()->create($newImage->toArray());
            $pivot = $project->images()->where('images.id', $insertedImage->id)->first()->pivot;

            $pivot->variable_name = "imgvar_".$id."_".$insertedImage->id;
            $pivot->save();
        }

        $project->image_id = $project->images()->get()[0]->id;
        $project->update();

        return redirect()->route('admin.projects.edit', $id)->withFlashSuccess('Images Uploaded!');
    }

    public function orderImages(Request $request, $id){
        $project = Project::find($id);

        if($project == null){
            return redirect()->route('admin.projects.index')->withFlashError('Project by that id does not exist');
        }

        $images = $project->images()->get();
        $orderArray = explode(',', $request->order);
        foreach($images as $image){
            $image->pivot->order = array_search($image->pivot->id, $orderArray);
            $image->pivot->save();
        }

        $project->image_id = $orderArray[0];
        $project->update();

        return redirect()->route('admin.projects.edit', $id)->withFlashSuccess('Image order updated!');
    }

    public function deleteImages(Request $request, $id){
        $project = Project::find($id);
        if(is_null($project)){
            return redirect()->route('admin.projects', $id)->withFlashError('No project with the specified id');
        }

        foreach(explode(',', $request->imageIds) as $imageId){
            $projectImage = ProjectImage::find($imageId);
            if(!$projectImage->delete()){
                return redirect()->route('admin.projects.edit', $id)->withFlashError('Failed to delete one or more images');
            }
        }

        $projectImage = $project->images()->first();

        if(!is_null($projectImage)) {
            $project->image_id = $projectImage->id;
        }else{
            $project->image_id = null;
        }
        $project->save();
        return redirect()->route('admin.projects.edit', $id)->withFlashSuccess('Images Deleted');
    }

    public function reorder(Request $request){
        $validatedJSON = $request->validate([
            'projects' => 'required|JSON'
        ]);

        $data = json_decode($validatedJSON['projects']);

        foreach($data as $JSONproject){
            $project = Project::find($JSONproject->project_id);
            $project->order = $JSONproject->order;
            if(!$project->save()){
                return response()->json([
                    'message' => 'Failed to update the project order!'
                ], 400);
            }
        }

        return response()->json([
            'message' => "Successfully updated the project order!"
        ], 200);
    }
}
