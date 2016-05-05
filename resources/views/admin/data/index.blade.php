@extends('admin.base')

@extends('admin.sidebar')

@section('content')

    <div class="am-cf am-padding">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">"{{$table->title}}"的数据列表</strong></div>
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
                    <th>ID</th>
                    @foreach($fields as $field)
                        <th>{{$field->name}}</th>
                    @endforeach
                    <th>管理</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        @foreach($fields as $key=>$field)
                            <th><?php $f = 'dt' . ($key + 1);?>{{$data->$f}}</th>
                        @endforeach
                        <td>
                            <a href="{{url('admin/table/'.$table->id.'/data/'.$data->id.'/delete')}}">
                                <button type="button" class="am-btn-sm am-btn-danger">删除</button>
                            </a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
            <?php
            $pagebar = str_replace('pagination', 'am-pagination am-pagination-centered', $datas->render());
            $pagebar = str_replace('disabled', 'am-disabled', $pagebar);
            $pagebar = str_replace('active', 'am-active', $pagebar);
            ?>
            {!!$pagebar!!}

            <div class="am-cf am-padding user-add">
                @if(count($datas))
                    <a href="{{url('admin/table/'.$table->id.'/data/download')}}">
                        <button type="button" class="am-btn am-btn-primary am-u-lg-4">下载数据</button>
                    </a>

                    <a onclick="return window.confirm('确定要清空已有数据吗？\n单击“确定”继续。单击“取消”停止。');"
                       href="{{url('admin/table/'.$table->id.'/data/clear')}}">
                        <button type="button" class="am-btn am-btn-warning am-u-lg-4">清空数据</button>
                    </a>
                @endif
                <button type="button" class="am-btn am-btn-default am-u-lg-4"
                        data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 650, height: 300}">导入数据
                </button>
            </div>

            <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
                <div class="am-modal-dialog">
                    <div class="am-modal-hd">添加字段
                        <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                    </div>
                    <div class="am-modal-bd">
                        <form class="am-form am-form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="am-form-group">
                                <label for="doc-ipt-1" class="am-u-sm-4 am-form-label">字段名称</label>
                                <div class="am-u-sm-3 am-u-end">
                                    <a href="{{url('admin/table/'.$table->id.'/data/template')}}">下载模板</a>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="doc-ipt-2" class="am-u-sm-4 am-form-label">导入数据</label>
                                <div class="am-u-sm-8">
                                    <input type="file" id="doc-ipt-2" name="file">
                                </div>
                            </div>

                            <div class="am-form-group">
                                <div class="am-u-sm-10">
                                    <button type="submit" class="am-btn am-btn-default">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection