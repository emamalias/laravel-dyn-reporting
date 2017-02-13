<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Meta;
use App\Report;
use DB;

class ReportsController extends Controller
{

	/**
	 * return the model class name with namespace
	 * @param  string $model
	 * @return string
	 */
	private function _getModelClass($model) {
		/**
    	 * this is just an example
    	 */
    	switch ($model) {
    		case 'websites':
    			$modelClass = 'App\Website';
    			break;
    		/**  other cases **/
    		default:
    			$modelClass = 'App\Website';
    			break;
    	}

		return $modelClass;
	}
	/**
	 * this will display all user reports
	 * @return view
	 */
	public function index() {
		$reports = auth()->user()->reports()->with('meta')->get();
		foreach($reports as $report) {
			foreach($report->meta as $meta) {
				$field = $meta->name;
				$report->$field = $meta->value;
			}
		}
		return view('reports.index', compact('reports'));
	}
	/**
	 * this will display the model and it's meta
	 * @param  Request $request
	 * @param  string  $model
	 * @param  integer  $id
	 * @return view
	 */
	public function show(Request $request, $model, $id) {
		$modelClass = $this->_getModelClass($model);

		$object = $modelClass::with('meta')->find($id);

    	return view('reports.view', compact('object', 'model'));
	}
	/**
	 * view the feedback form for the model
	 * @param  Request $request
	 * @param  string  $model
	 * @param  integer  $id
	 * @return view
	 */
	public function new(Request $request, $model, $id) {
		$modelClass = $this->_getModelClass($model);

		$object = $modelClass::with('meta')->find($id);

    	return view('reports.new', compact('object', 'model'));
	}
	/**
	 * view the existing feedback and able to change it
	 * @param  Request $request
	 * @param  string  $model
	 * @param  integer  $id id of the report
	 * @return view
	 */
	public function edit(Request $request, $model, $id) {
		$report = Report::find($id);
		foreach($report->meta as $meta) {
			$field = $meta->name;
			$report->$field = $meta->value;
		}

		$object = $report->model::with('meta')->find($report->model_id);
		
    	return view('reports.edit', compact('report', 'object', 'model'));
	}
	/**
	 * lists of object by model eg: Websites
	 * @param  Request $request
	 * @param  string  $model
	 * @return view
	 */
    public function lists(Request $request, $model) {

    	$modelClass = $this->_getModelClass($model);

    	$lists = [];

    	$lists = (new $modelClass)->reportable()->get();

    	return view('reports.lists', compact('lists'));
    }
    /**
     * save new feedback
     * @param  Request $request
     * @param  string  $model
     * @param  integer  $id
     * @return mixed
     */
    public function store(Request $request, $model, $id) {
    	$this->validate($request, [
            'feedback' => 'required|min:10'
        ]);

    	DB::beginTransaction();

    	try {
    		$modelClass = $this->_getModelClass($model);

	        $user = auth()->user();
	        $report = $user->reports()->create([]); //initialized new report

	        //add meta to report
	        $report->meta()->saveMany([
	        	new Meta([
	    			'name' => 'model',
	    			'label' => 'Model',
	    			'value' => $modelClass
	    		]),
	    		new Meta([
	    			'name' => 'model_id',
	    			'label' => 'Model ID',
	    			'type' => 'integer',
	    			'value' => $id
	    		]),
	    		new Meta([
	    			'name' => 'feedback',
	    			'label' => 'Feedback',
	    			'value' => $request->get('feedback')
	    		]),
	        ]);

    		DB::commit();

    		return back()->withSuccess('Feedback submitted. Thank you!');

    	} catch(\Exception $e) {

    		DB::rollback();

    		return back()->withError('I\'m sorry Feedback not submitted. Please contact the administrator');

    	}
        

        
    }
    /**
     * update existing feedback
     * @param  Request $request
     * @param  string  $model
     * @param  integer  $id
     * @return mixed
     */
    public function update(Request $request, $model, $id) {
    	$this->validate($request, [
            'feedback' => 'required|min:10'
        ]);

    	DB::beginTransaction();

    	try {

	        $user = auth()->user();
	        $report = $user->reports()->find($id);

	        foreach($report->meta as $meta) {
	        	if($meta->name == 'feedback') {
	        		$meta->value = $request->get('feedback');
	        		$meta->save();
	        	}
	        }

    		DB::commit();

    		return back()->withSuccess('Feedback saved. Thank you!');

    	} catch(\Exception $e) {

    		DB::rollback();

    		return back()->withError('I\'m sorry Feedback not saved. Please contact the administrator');

    	}
        

        
    }
}
