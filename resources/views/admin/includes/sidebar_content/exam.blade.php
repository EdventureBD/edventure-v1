<li
    class="nav-item has-treeview {{ request()->is('admin/exam') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/exam/create') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/exam/*/edit') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/exam/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/add-mcq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/student-exam-attempt') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/cq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/mcq/*') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/all-mcq') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/all-cq') ? 'menu-open' : '' }} 
                                {{ request()->is('admin/all-assignment') ? 'menu-open' : '' }} 
">
    <a href="#"
        class="nav-link {{ request()->is('admin/exam') ? 'active' : '' }} 
{{ request()->is('admin/exam/create') ? 'active' : '' }} 
{{ request()->is('admin/exam/*/edit') ? 'active' : '' }} 
{{ request()->is('admin/exam/*') ? 'active' : '' }} 
{{ request()->is('admin/add-mcq/*') ? 'active' : '' }} 
{{ request()->is('admin/student-exam-attempt') ? 'active' : '' }} 
{{ request()->is('admin/cq/*') ? 'active' : '' }} 
{{ request()->is('admin/mcq/*') ? 'active' : '' }} 
{{ request()->is('admin/all-mcq') ? 'active' : '' }} 
{{ request()->is('admin/all-cq') ? 'active' : '' }} 
{{ request()->is('admin/all-assignment') ? 'active' : '' }} 
">
        <i class="fas fa-paste"></i>
        <p>&nbsp; Exam<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">

        <li
            class="nav-item has-treeview {{ request()->is('admin/exam') ? 'menu-open' : '' }} 
        {{ request()->is('admin/all-mcq') ? 'menu-open' : '' }} 
        {{ request()->is('admin/all-cq') ? 'menu-open' : '' }} 
        {{ request()->is('admin/all-assignment') ? 'menu-open' : '' }} 
        ">
            <a href="{{ route('showAllMCQ') }}"
                class="nav-link {{ request()->is('admin/all-mcq') ? 'active' : '' }} ">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>MCQ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('showAllCQ') }}"
                class="nav-link {{ request()->is('admin/all-cq') ? 'active' : '' }} ">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>CQ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('showAllAssignment') }}"
                class="nav-link {{ request()->is('admin/all-assignment') ? 'active' : '' }}">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>Assignment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('exam.index') }}"
                class="nav-link {{ request()->is('admin/exam') ? 'active' : '' }}">
                &nbsp;<i class="fas fa-volleyball-ball"></i>
                <p>&nbsp; All Exam</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('student-exam-attempt.index') }}"
                class="nav-link {{ request()->is('admin/student-exam-attempt') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Exam Attempt</p>
            </a>
        </li>
    </ul>
</li>
