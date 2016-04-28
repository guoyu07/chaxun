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
					<th>ID</th><th>字段名称</th><th>排序</th><th>查询值</th><th>是否显示</th><th>管理</th>
				</tr>
				</thead>
				<tbody>

				@foreach ($fields as $field)
				<tr><td>{{$field->id}}</td><td>{{$field->name}}</td><td>{{$field->orderno}}</td><td>{{$field->input}}</td><td>{{$field->isshow}}</td>
					<td>
						<button type="button" class="am-btn-sm am-btn-primary">主色按钮</button>
						<button type="button" class="am-btn-sm am-btn-secondary">次色按钮</button>
						<button type="button" class="am-btn-sm am-btn-success">绿色按钮</button>
						<button type="button" class="am-btn-sm am-btn-warning">橙色按钮</button>
						<button type="button" class="am-btn-sm am-btn-danger">红色按钮</button>
						<div class="am-dropdown" data-am-dropdown>
							<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
							<ul class="am-dropdown-content">
								<!-- <li><a href="#">查看</a></li> -->
								<li><a href="{{ URL('admin/table/'.$field->id.'/edit') }}">编辑</a></li>
								<li><a href="{{ URL('admin/table/'.$field->id.'/field') }}">字段管理</a></li>
								<li><a href="#" onclick="$('#table_del_{{$field->id}}').submit();">删除</a></li>

								<form action="{{ URL('admin/table/'.$field->id) }}" method="POST" id="table_del_{{$field->id}}">
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


		</div>
	</div>

@endsection