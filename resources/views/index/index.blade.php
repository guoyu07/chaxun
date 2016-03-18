@extends('index._index')

@section('content')
	<div class="get">
	  <div class="am-g">
	    <div class="am-u-lg-12">
	      <h1 class="get-title">当前查询项目</h1>
	      <table class="am-table am-table-hover">
	        <thead>
	          <tr>
	            <th class="am-text-center">编号</th>
	            <th class="am-text-center">查询内容</th>
	            <th class="am-text-center">开始时间</th>
	            <th class="am-text-center">结束时间</th>
	            <th class="am-text-center">操作</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach ($tables as $table)
	            <tr>
	              <td>#{{$table->id}}</td>
	              <td>{{$table->title}}</td>
	              <td>{{$table->id}}</td>
	              <td>2016-03-12</td>
	              <td>
	                  <a href="/show/{{$table->id}}" class="am-btn am-btn-xs get-btn">查询</a>
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
	</div>
@endsection