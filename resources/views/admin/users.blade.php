@extends('admin.base')

@extends('admin.sidebar')

@section('content')

	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户列表</strong></div>
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
					<th>ID</th><th>用户名</th><th>邮箱</th><th>注册时间</th><th>最后登录时间</th><th>管理</th>
				</tr>
				</thead>
				<tbody>

				@foreach ($users as $user)
				<tr><td>{{$user->id}}</td><td>{{$user->name}}</td><td>{{$user->email}}</td><td>{{$user->created_at}}</td><td>{{$user->updated_at}}</td>
					<td>
						<div class="am-dropdown" data-am-dropdown>
							<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
							<ul class="am-dropdown-content">
								<!-- <li><a href="#">查看</a></li> -->
								<li><a href="{{ URL('admin/user/'.$user->id.'/edit') }}">编辑</a></li>
								<li><a href="#" onclick="$('#user_del_{{$user->id}}').submit();">删除</a></li>

								<form action="{{ URL('admin/user/'.$user->id) }}" method="POST" id="user_del_{{$user->id}}">
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
			<div class="am-cf am-padding user-add">
				<button type="button" class="am-btn am-btn-primary" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 650, height: 300}">添加用户</button>

				<div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
					<div class="am-modal-dialog">
						<div class="am-modal-hd">添加用户
							<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
						</div>
						<div class="am-modal-bd">
							<form class="am-form am-form-horizontal" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="am-form-group">
									<label for="doc-ipt-1" class="am-u-sm-2 am-form-label">用户名</label>
									<div class="am-u-sm-10">
										<input type="text" id="doc-ipt-1" name="name" placeholder="输入登录帐号">
									</div>
								</div>

								<div class="am-form-group">
									<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">电子邮件</label>
									<div class="am-u-sm-10">
										<input type="email" id="doc-ipt-3" name="email" placeholder="输入电子邮件">
									</div>
								</div>

								<div class="am-form-group">
									<label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">密码</label>
									<div class="am-u-sm-10">
										<input type="password" id="doc-ipt-pwd-2" name="password" placeholder="设置一个密码吧">
									</div>
								</div>

								<div class="am-form-group">
									<div class="am-u-sm-10">
										<button type="submit" class="am-btn am-btn-default">保存</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

@endsection