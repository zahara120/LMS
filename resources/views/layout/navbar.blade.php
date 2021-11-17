<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">

    <li class="{{ request()->is('dashboard') ? 'active' : "" }}"><a href="/dashboard"><i class="fa"></i> <span>Dashboard</span></a></li>
  
      {{-- @if(auth()->user()->role()->nameRole='Admin') --}}
      
    <li class="{{ request()->is('test') ? 'active' : "" }}"><a href="/test"><i class="fa"></i> <span>Quiz</span></a></li>

    <li class="{{ request()->is('forum') ? 'active' : "" }}"><a href="/forum"><i class="fa"></i> <span>Forum</span></a></li>
  
    <li class="{{ request()->is('test/create') ? 'active' : "" }}"><a href="/test/create"><i class="fa"></i> <span>Create Test</span></a></li>
  
    <li class="{{ request()->is('approval') ? 'active' : "" }}"><a href="/approval"><i class="fa"></i> <span>Approval Record</span></a></li>
  
      {{-- <li class="{{ request()->is('setting') ? 'active' : "" }}"> --}}
        <li class="treeview">
        <a href="/setting">
          <i class="fa"></i> <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-fw fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="/answer"><i class="fa fa-circle-o"></i>Create Answer</a></li>
          <li><a href="/question"><i class="fa fa-circle-o"></i>Create Question</a></li>
          <li><a href="/lesson"><i class="fa fa-circle-o"></i>Lesson Training</a></li>
          <li><a href="/categorytraining"><i class="fa fa-circle-o"></i>Category Training</a></li>
          <li><a href="/subcategorytraining"><i class="fa fa-circle-o"></i>Subcategory Training</a></li>
          <li><a href="/exam"><i class="fa fa-circle-o"></i>Create Test</a></li>
          <li><a href="/venue"><i class="fa fa-circle-o"></i>Venue Training</a></li>
          <li><a href="/room"><i class="fa fa-circle-o"></i>Room Training</a></li>
          <li><a href="/provider"><i class="fa fa-circle-o"></i>Provider</a></li>
          <li><a href="/user"><i class="fa fa-circle-o"></i>User</a></li>
          <li><a href="/role"><i class="fa fa-circle-o"></i>Role</a></li>
        </ul>
      </li>
  
      {{-- role:User
      @elseif(auth()->user()->role()->where('nameRole', '=', 'User')) --}}
      {{-- @elseif(auth()->user()->role()->nameRole='User') --}}
  
      <li class="{{ request()->is('approval/create') ? 'active' : "" }}"><a href="/approval/create"><i class="fa"></i> <span>Add Training Submission</span></a></li>
      
      {{-- @endif --}}
      {{-- <li class="{{ request()->is('setting') ? 'active' : "" }}"><a href="/setting"><i class="fa"></i> <span>Setting</span></a></li> --}}
  
    </ul>