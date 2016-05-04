<?php

	namespace App\Http\Controllers\Admin;

	use Illuminate\Http\Request;
	use App\Table;
	use App\Http\Requests;
	use Redirect, Input, Auth;
	use App\Http\Controllers\Controller;

	class TableController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			if (Auth::user()->level == 1) {
				return view('admin.table.index')->withTables(Table::paginate(6));
			} else {
				return view('admin.table.index')->withTables(Auth::user()->tables()->paginate(6));
			}

		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('admin.table.create');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
			$this->validate($request, [
				'title' => 'required|max:255',
				'uid' => 'required',
				'start_time' => 'required',
				'end_time' => 'required',
				'status' => 'required',
			]);
			Table::create([
				'title' => Input::get('title'),
				'uid' => Input::get('uid'),
				'start_time' => strtotime(Input::get('start_time')),
				'end_time' => strtotime(Input::get('end_time')),
				'status' => Input::get('status'),
				'fieldstatus' => 0,
				'note' => Input::get('note'),
			]);

			return Redirect('admin/table');
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
			return view('admin.table.edit')->withtable(Table::find($id));
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

			$this->validate($request, [
				'title' => 'required|max:255',
				'start_time' => 'required',
				'end_time' => 'required',
				'status' => 'required',
			]);

			$table = Table::find($id);
			$table->title = Input::get('title');
			$table->start_time = strtotime(Input::get('start_time'));
			$table->end_time = strtotime(Input::get('end_time'));
			$table->status = Input::get('status');
			$table->note = Input::get('note');
			if (Auth::user()->id == $table->uid) {
				if ($table->save()) {
					return Redirect::to('admin/table');
				} else {
					return Redirect::back()->withInput()->withErrors('保存失败！');
				}
			} else {
				if (Auth::user()->level == 1) {
					if ($table->save()) {
						return Redirect::to('admin/table');
					} else {
						return Redirect::back()->withInput()->withErrors('保存失败！');
					}
				} else {
					return Redirect::to('admin/table')->withErrors('无权编辑！');
				}
			}

		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{

			$table = Table::find($id);
			if (Auth::user()->level == 1) {
				$table->delete();

				return Redirect::to('admin/table');
			} else {
				if ($table->user->id == Auth::user()->id) {
					$table->delete();

					return Redirect::to('admin/table');
				} else {
					return Redirect('admin/table')
						->withErrors(['tips' => '权限不足！',]);
				}
			}
		}
	}
