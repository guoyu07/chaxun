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

			<div class="am-cf am-padding user-add">
				<form class="am-form am-form-horizontal" method="post" action="{{ URL('admin/user/'.$user->id) }}">
					<input name="_method" type="hidden" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$user->id}}" >
					<div class="am-form-group">
						<label for="doc-ipt-1" class="am-u-sm-2 am-form-label">用户名</label>
						<div class="am-u-sm-10">
							<input type="text" id="doc-ipt-1" name="name" value="{{$user->name}}" placeholder="输入登录帐号">
						</div>
					</div>

					<div class="am-form-group">
						<label for="doc-ipt-3" class="am-u-sm-2 am-form-label">电子邮件</label>
						<div class="am-u-sm-10">
							<input type="email" id="doc-ipt-3" name="email" value="{{$user->email}}" placeholder="输入电子邮件">
						</div>
					</div>

					<div class="am-form-group">
						<label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label">密码</label>
						<div class="am-u-sm-10">
							<input type="password" id="doc-ipt-pwd-2" name="password" placeholder="设置一个密码吧">
						</div>
					</div>

					<div class="am-form-group">
					<label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label"></label>
						<div class="am-u-sm-10">
							<button type="submit" class="am-btn am-btn-default">保存</button>
						</div>
					</div>
					<label for="doc-ipt-pwd-2" class="am-u-sm-2 am-form-label"></label>
				</form>

			</div>

		</div>
	</div>

@endsection