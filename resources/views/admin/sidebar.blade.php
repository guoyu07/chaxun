
@section('sidebar')
    <div class="am-offcanvas-bar admin-offcanvas-bar">
      <ul class="am-list admin-sidebar-list">
        <li><a href="/admin"><span class="am-icon-home"></span> 首页</a></li>
        <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#collapse-nav'}"><span class="am-icon-file"></span> 查询管理 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-nav">
            <li><a href="/admin/table"><span class="am-icon-check"></span> 查询列表<span class="am-badge am-badge-secondary am-margin-right am-fr">{{ App\Table::all()->count() }}</span></a></li>
            <li><a href="/admin/table/create"><span class="am-icon-check"></span> 添加查询</a></li>
          </ul>
        </li>
        <li><a href="admin-table.html"><span class="am-icon-table"></span> 日志管理</a></li>
        <li><a href="/admin/user"><span class="am-icon-users"></span> 用户管理</a></li>
        <li><a href="/auth/logout"><span class="am-icon-sign-out"></span> 注销</a></li>
      </ul>

      <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>时光静好，与君语<br>细水流年，与君同</p>
        </div>
      </div>

    </div>
@endsection