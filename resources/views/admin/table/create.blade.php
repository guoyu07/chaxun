@extends('admin.base')

@extends('admin.sidebar')

@section('content')
<link rel="stylesheet" href="/assets/css/amazeui.datetimepicker.css">
<script src="/assets/js/amazeui.datetimepicker.js"></script>


	<div class="am-cf am-padding">
		<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">新建查询</strong></div>
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

			<form class="am-form" method="post" action="{{ URL('admin/table') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input name="uid" value="{{Auth::user()->id}}" type="hidden">
			  <fieldset>
			    <div class="am-form-group">
			      <label for="doc-ipt-text-1">标题</label>
			      <input type="text" name="title" id="doc-ipt-text-1" placeholder="输入查询标题">
			    </div>

				<div class="am-form-group am-form-icon">
				<label for="doc-select-2">时间控制</label>
				    <i class="am-icon-calendar"></i>
				    <input size="16" type="text" name="start_time" value="" class="form-datetime-start am-form-field" placeholder="查询开始时间">
				  </div>

				<div class="am-form-group am-form-icon">
				    <i class="am-icon-calendar"></i>
				    <input size="16" type="text" name="end_time" value="" class="form-datetime-end am-form-field" placeholder="查询结束时间">
				  </div>

			    <div class="am-form-group">
			      <label for="doc-select-1">查询状态</label>
			      <select id="doc-select-1" name="status">
			        <option value="1">启用</option>
			        <option value="2">关闭</option>
			      </select>
			      <span class="am-form-caret"></span>
			    </div>

			    <div class="am-form-group">
			      <label for="doc-ta-1">文本域</label>
			      <textarea class="" name="note" rows="5" id="doc-ta-1"></textarea>
			    </div>

			    <p><button type="submit" class="am-btn am-btn-default">提交</button></p>
			  </fieldset>
			</form>



<script>
(function($){
  $.fn.datetimepicker.dates['zh-CN'] = {
    days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
    daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
    daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
    months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
    monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
    today: "今日",
    suffix: [],
    meridiem: ["上午", "下午"]
  };

  $('.form-datetime-start').datetimepicker({
    language:  'zh-CN',
    format: 'yyyy-mm-dd hh:ii'
  });
  $('.form-datetime-end').datetimepicker({
    language:  'zh-CN',
    format: 'yyyy-mm-dd hh:ii'
  });
}(jQuery));
</script>

		</div>
	</div>

@endsection