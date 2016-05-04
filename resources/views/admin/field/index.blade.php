@extends('admin.base')

@extends('admin.sidebar')

@section('content')

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">字段列表</strong></div>
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

            <form method="post" action="{{url('admin/table/'.$table->id.'/field/edit')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <table class="am-table am-table-bd am-table-striped admin-content-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>字段名称</th>
                        <th>排序（数字越小越靠前）</th>
                        <th>查询条件</th>
                        <th>是否显示（查询结果）</th>
                        <th>管理</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($fields as $field)
                        <tr>
                            <td>{{$field->id}}</td>
                            <td><input type="text" name="postdata[{{$field->id}}][name]" value="{{$field->name}}"</td>
                            <td><input type="text" name="postdata[{{$field->id}}][orderno]" value="{{$field->orderno}}" size="10"></td>
                            <td>
                                <div class="am-btn-group" data-am-button>
                                    <label class="am-btn am-btn-default am-btn-xs @if(!$field->input) am-active @endif">
                                        <input type="radio" name="postdata[{{$field->id}}][input]" value="0"> 否
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs @if($field->input) am-active @endif">
                                        <input type="radio" name="postdata[{{$field->id}}][input]" value="1"> 是
                                    </label>
                                </div>
                                <script>
                                    $(function () {
                                        $("input[name='postdata[{{$field->id}}][input]']").eq({{$field->input}}).attr("checked", "checked");
                                        {{--var $input{{$field->id}} = $('[name="postdata[{{$field->id}}][input]"]');--}}
                                        {{--$input{{$field->id}}.on('change', function () {--}}
                                        {{--console.log('单选框当前选中的是：',$input{{$field->id}}.filter(':checked').val());--}}
                                        {{--});--}}
                                    });
                                </script>
                            </td>
                            <td>
                                <div class="am-btn-group" data-am-button>
                                    <label class="am-btn am-btn-default am-btn-xs @if(!$field->isshow) am-active @endif">
                                        <input type="radio" name="postdata[{{$field->id}}][isshow]" value="0"> 否
                                    </label>
                                    <label class="am-btn am-btn-default am-btn-xs @if($field->isshow) am-active @endif">
                                        <input type="radio" name="postdata[{{$field->id}}][isshow]" value="1"> 是
                                    </label>
                                </div>
                                <script>
                                    $(function () {
                                        $("input[name='postdata[{{$field->id}}][isshow]']").eq({{$field->input}}).attr("checked", "checked");
                                    });
                                </script>
                            </td>
                            <td>@if(!$table->fieldstatus)
                                <a href="{{url('admin/table/'.$table->id.'/field/'.$field->id.'/delete')}}">
                                    <button type="button" class="am-btn-sm am-btn-danger">删除字段</button>
                                </a>@endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="am-cf am-padding user-add">
                    <button type="submit" class="am-btn am-btn-primary am-u-lg-4">保存修改</button>
                    @if(!$table->fieldstatus)
                        <a onclick="return window.confirm('是否要保存字段列表？保存后将不能修改，请仔细确认！\n单击“确定”继续。单击“取消”停止。');"
                       href="{{url('admin/table/'.$table->id.'/field/save')}}">
                        <button type="button" class="am-btn am-btn-warning am-u-lg-4">保存字段列表</button>
                    </a>
                    @endif
                    <button type="button" class="am-btn am-btn-default am-u-lg-4"
                            data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 650, height: 300}">添加字段
                    </button>
                </div>
            </form>

            <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
                <div class="am-modal-dialog">
                    <div class="am-modal-hd">添加字段
                        <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                    </div>
                    <div class="am-modal-bd">
                        <form class="am-form am-form-horizontal" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="am-form-group">
                                <label for="doc-ipt-1" class="am-u-sm-4 am-form-label">字段名称</label>
                                <div class="am-u-sm-8">
                                    <input type="text" id="doc-ipt-1" name="name">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-2" class="am-u-sm-4 am-form-label">字段排序</label>
                                <div class="am-u-sm-8">
                                    <input type="text" id="doc-ipt-2" name="orderno">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-3" class="am-u-sm-4 am-form-label">是否是查询条件</label>
                                <div class="am-u-sm-2 am-u-end">
                                    <input type="checkbox" id="doc-ipt-3" name="input">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-4" class="am-u-sm-4 am-form-label">查询结果是否显示</label>
                                <div class="am-u-sm-2 am-u-end">
                                    <input type="checkbox" id="doc-ipt-4" name="isshow">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-10">
                                    <button type="submit" class="am-btn am-btn-default"  @if($table->fieldstatus)  onclick="return window.confirm('当前查询已保存字段，确定要修改字段列表吗？修改后已有数据将会清空！\n单击“确定”继续。单击“取消”停止。');"@endif>保存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection