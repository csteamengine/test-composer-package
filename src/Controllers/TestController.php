<?php namespace Csteamengine\TestComposerPackage\Controllers;

use Csteamengine\TestComposerPackage\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestController extends Controller
{
    protected $debugbar;

    public function __construct(Request $request)
    {

    }

    public function index(){
        $testModel = new TestModel();

        return view('test-composer-package::test', ['test' => $testModel->getTest()]);
    }
}