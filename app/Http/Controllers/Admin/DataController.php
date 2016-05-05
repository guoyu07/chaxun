<?php

	namespace App\Http\Controllers\Admin;

	use Illuminate\Http\Request;
	use App\Table, App\Field, App\Data;
	use App\Http\Requests;
	use Redirect, Input, Auth;
	use Storage, Excel;
	use App\Http\Controllers\Controller;

	class DataController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index($tableid)
		{
			//TODO:用户权限、data权限
			$table = Table::find($tableid);

			return view('admin.data.index')->withDatas(Data::paginate(6))->withTable($table)->withFields($table->fields)->withFieldnum(count($table->fields));
		}

		//下载数据
		public function download($tableid)
		{
			$table = Table::find($tableid);
			$cellData = [];
			$tmp_array = [];

			foreach ($table->fields as $field) {
				$tmp_array[] = $field->name;
			}
			$cellData[] = $tmp_array;
			$tmp_array = [];

			$datas = Data::all();
			foreach ($datas as $data) {
				for ($i = 1; $i <= count($table->fields); $i++) {
					$f_name = 'dt' . $i;
					$tmp_array[] = $data->$f_name;
				}
				$cellData[] = $tmp_array;
				$tmp_array = [];
			}

			Excel::create($table->title, function($excel) use ($cellData) {
				$excel->sheet('导出数据', function($sheet) use ($cellData) {
					$sheet->rows($cellData);
				});
			})->export('xlsx');

			return Redirect::back();
		}

		//下载模板
		public function template($tableid)
		{
			$table = Table::find($tableid);
			$cellData = [];
			$tmp_array = [];

			foreach ($table->fields as $field) {
				$tmp_array[] = $field->name;
			}
			$cellData[] = $tmp_array;
			$tmp_array = [];


			Excel::create($table->title . '模板', function($excel) use ($cellData) {
				$excel->sheet('模板', function($sheet) use ($cellData) {
					$sheet->rows($cellData);
				});
			})->export('xlsx');

			return Redirect::back();
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
			$file = $request->file('file');
			$newFileName = md5(time() . rand(0, 10000)) . '.' . $file->getClientOriginalExtension();
			$savePath = 'xlsx/' . $newFileName;
			$newfile = Storage::copy($_FILES[ 'file' ][ 'tmp_name' ], $savePath);
			dd($newfile);


			$table = Table::find($tableid);
			$file = $request->file('file');
			if ($file->isValid()) {
				$realPath = $_FILES[ 'file' ][ 'tmp_name' ];
				Excel::load($realPath, function($reader) {
					$data = $reader->all();
					dd($data);
				});
			}

			dd($request);
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
		 * @param  int                      $id
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
		public function destroy($tid, $did)
		{

			$data = Data::find($did);
			$data->delete();

			return Redirect::back();

		}
	}
