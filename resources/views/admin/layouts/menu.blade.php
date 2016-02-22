<li {!! (Request::is('admin/requirements') || Request::is('admin/requirements/create') || Request::is('admin/requirements/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Requirements</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/requirements') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/requirements') }}">
                <i class="fa fa-angle-double-right"></i>
                Requirements
            </a>
        </li>
        <li {!! (Request::is('admin/requirements/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/requirements/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Requirement
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/agents') || Request::is('admin/agents/create') || Request::is('admin/agents/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Agents</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/agents') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/agents') }}">
                <i class="fa fa-angle-double-right"></i>
                Agents
            </a>
        </li>
        <li {!! (Request::is('admin/agents/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/agents/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Agent
            </a>
        </li>
    </ul>
</li><li {!! (Request::is('admin/groups') || Request::is('admin/groups/create') || Request::is('admin/groups/*') ? 'class="active"' : '') !!}>
    <a href="#">
        <i class="livicon" data-name="list-ul" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
        <span class="title">Groups</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="sub-menu">
        <li {!! (Request::is('admin/groups') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/groups') }}">
                <i class="fa fa-angle-double-right"></i>
                Groups
            </a>
        </li>
        <li {!! (Request::is('admin/groups/create') ? 'class="active" id="active"' : '') !!}>
            <a href="{{ URL::to('admin/groups/create') }}">
                <i class="fa fa-angle-double-right"></i>
                Add New Group
            </a>
        </li>
    </ul>
</li>