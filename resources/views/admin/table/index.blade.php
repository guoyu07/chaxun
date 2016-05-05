@extends('admin.base')

@extends('admin.sidebar')

@section('content')

	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">查询列表</strong></div>
	</div>

	<div class="am-g">
		<div class="am-u-sm-12">
		@if (count($errors) > 0)
			<div class="am-alert am-alert-warning" id="login-error" data-am-alert>
				<button type="button" class="am-close">×</button>
				<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
				 </ul>
			</div>
			<script>$('#login-error').alert();</script>
		@endif
			<table class="am-table am-table-bd am-table-striped admin-content-table">
				<thead>
				<tr>
					<th>ID</th><th>查询名称</th><th>创建用户</th><th>开始时间</th><th>结束时间</th><th>状态</th><th>管理</th>
				</tr>
				</thead>
				<tbody>

				@foreach ($tables as $table)
				<tr><td>{{$table->id}}</td><td>{{$table->title}}</td><td>{{$table->user->name}}</td><td>{{$table->created_at}}</td><td>{{$table->updated_at}}</td><td>{{ config('chaxun.table.status.'.$table->status) }}</td>
					<td>
						<div class="am-dropdown" data-am-dropdown>
							<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
							<ul class="am-dropdown-content">
								<!-- <li><a href="#">查看</a></li> -->
								<li><a href="{{ URL('admin/table/'.$table->id.'/edit') }}">编辑</a></li>
								<li><a href="{{ URL('admin/table/'.$table->id.'/field') }}">字段管理</a></li>
								@if($table->fieldstatus) <li><a href="{{ URL('admin/table/'.$table->id.'/data') }}">数据管理</a></li>@endif
								<li><a href="#" onclick="$('#table_del_{{$table->id}}').submit();">删除</a></li>

								<form action="{{ URL('admin/table/'.$table->id) }}" method="POST" id="table_del_{{$table->id}}">
									<input name="_method" type="hidden" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>

							</ul>
						</div>
					</td>
				</tr>
				@endforeach

				</tbody>
			</table>
<?php
$pagebar = str_replace('pagination', 'am-pagination am-pagination-centered', $tables->render());
$pagebar = str_replace('disabled', 'am-disabled', $pagebar);
$pagebar = str_replace('active', 'am-active', $pagebar);
?>
{!!$pagebar!!}

		</div>
	</div>

@endsection