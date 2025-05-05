<aside class="left-sidebar" data-sidebarbg="skin5">
    <center><h5>{{auth()->user()->name}}</a></h5></center>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('Home')}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Home</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('profile')}}"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Profile</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Tools
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.numbers.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> Numbers </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.shipping.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> Shipping </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.send.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> Send Email </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Users
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.users.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> All Users </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Sections
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.sections.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> All Sections </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.sections.create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span
                            class="hide-menu"> Add Section </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Products
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.products.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> All Products </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.products.create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span
                            class="hide-menu"> Add Product </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Orders
                        </span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.orders.index')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span
                                    class="hide-menu"> All Orders </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
