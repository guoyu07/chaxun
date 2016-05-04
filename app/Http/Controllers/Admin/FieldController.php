<?php

	namespace App\Http\Controllers\Admin;

	use Illuminate\Http\Request;
	use App\Field;
	use App\Table;
	use App\Http\Requests;
	use Redirect, Input, Auth;
	use App\Http\Controllers\Controller;

	class FieldController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index($tableid)
		{//TODO:ORDER
			return view('admin.field.index')->withFields(Table::find($tableid)->fields)->withTable(Table::find($tableid));
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store($tableid, Request $request)
		{
			Field::create([
				'tid' => $tableid,
				'name' => Input::get('name'),
				'orderno' => Input::get('orderno'),
				'input' => ((Input::get('input') == 'on') ? 1 : 0),
				'isshow' => ((Input::get('isshow') == 'on') ? 1 : 0),
			]);

			$table = Table::find($tableid);
			if ($table->fieldstatus == 1) {
				$table->fieldstatus = 0;
				$table->save();
				//TODO：清空数据
			}

			return Redirect('admin/table/' . $tableid . '/field');
		}

		public function editfield($tableid, Request $request)
		{
			$fields = $request->postdata;
			foreach ($fields as $k => $v) {
				$field = Field::find($k);
				$field->name = $v[ 'name' ];
				$field->orderno = $v[ 'orderno' ];
				$field->input = $v[ 'input' ];
				$field->isshow = $v[ 'isshow' ];
				$field->save();
			}

			return Redirect::back();
		}

		public function savefield($tableid)
		{
			$table = Table::find($tableid);
			$table->fieldstatus = 1;
			$table->save();

			return Redirect::back();
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public
		function show($id)
		{
			//
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public
		function edit($id)
		{
			//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 * @return \Illuminate\Http\Response
		 */
		public
		function update(Request $request, $id)
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public
		function destroy($tid, $fid)
		{
			$table = Table::find($tid);
			if ($table->fieldstatus) {
				return Redirect::back()->withErrors(['tips' => '权限不足！',]);
			} else {
				$field = Field::find($fid);
				$field->delete();

				return Redirect::back();
			}

		}
	}
