  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img src="{{ asset('assets/admin/auth/images/logo.jpg') }}" alt="Go Express Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Go Express</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('assets/admin/auth/images/logo.jpg') }}" class="img-circle elevation-2" alt="Admin Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ auth('admin')->user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                  <li class="nav-item">
                      <a href="pages/widgets.html" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Widgets
                              <span class="right badge badge-danger">New</span>
                          </p>
                      </a>
                  </li>




                  {{-- المحافظات GOVERNORATES  --}}
                  <li class="nav-item has-treeview menu-open">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'governorates') active @endif">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              المحافظات
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('governorates.index') }}"
                                  class="nav-link @if (Request::segment(2) == 'governorates') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل المحافظات</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="./index3.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> المحافظات المحذوفة</p>
                              </a>
                          </li>
                      </ul>
                  </li>





                  {{-- المدن CITIES --}}
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'cities') active @endif">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              المدن
                              <i class="fas fa-angle-left right"></i>
                              <span class="badge badge-info right">6</span>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('cities.index') }}"
                                  class="nav-link @if (Request::segment(2) == 'cities') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل المدن</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/layout/boxed.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>المدن المحذوفة</p>
                              </a>
                          </li>
                      </ul>
                  </li>




                   {{-- الموردين SUPPLIERS --}}
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'suppliers') active @endif">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              الموردين
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('suppliers.index') }}" class="nav-link @if (Request::segment(2) == 'suppliers') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل الموردين</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/charts/flot.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>الموردين المحذوفين</p>
                              </a>
                          </li>
                      </ul>
                  </li>


                    {{-- المناديب SERVANTS  --}}
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'servants') active @endif">
                          <i class="nav-icon fas fa-tree"></i>
                          <p>
                              المناديب
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('servants.index') }}" class="nav-link @if (Request::segment(2) == 'servants') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل المناديب</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/UI/icons.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>المناديب المحذوفة</p>
                              </a>
                          </li>
                      </ul>
                  </li>


                  {{-- الشحنات PRODUCTS  --}}
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'products') active @endif">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                              الشحنات الجديدة
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('products.index') }}" class="nav-link @if (Request::segment(2) == 'products') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل الشحنات الجديدة</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/forms/advanced.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>الشحنات المحذوفة</p>
                              </a>
                          </li>

                      </ul>
                  </li>



                  {{-- خطوط السير ORDERS --}}
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'orders') active @endif">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              خطوط السير
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('orders.index') }}" class="nav-link @if (Request::segment(2) == 'orders') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل خطوط السير</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/tables/data.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>كل خطوط السير المنتهية</p>
                              </a>
                          </li>
                      </ul>
                  </li>





                   {{--  التقارير REBORTS --}}
                  <li class="nav-item has-treeview @if (Request::segment(2) == 'reborts') menu-open @endif">
                      <a href="#" class="nav-link @if (Request::segment(2) == 'reborts') active @endif">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              التقارير
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('reborts.index') }}" class="nav-link @if (Request::segment(2) == 'reborts' &&  Request::segment(3) == '') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>تقارير الموردين </p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('reborts.index_servants') }}" class="nav-link @if (Request::segment(2) == 'reborts' &&  Request::segment(3) == 'servants') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> تقارير المناديب </p>
                              </a>
                          </li>


                           <li class="nav-item">
                              <a href="pages/tables/data.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p> تقارير داخلية </p>
                              </a>
                          </li>
                      </ul>
                  </li>






                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                      <a href="pages/calendar.html" class="nav-link">
                          <i class="nav-icon far fa-calendar-alt"></i>
                          <p>
                              Calendar
                              <span class="badge badge-info right">2</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="pages/gallery.html" class="nav-link">
                          <i class="nav-icon far fa-image"></i>
                          <p>
                              Gallery
                          </p>
                      </a>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-envelope"></i>
                          <p>
                              Mailbox
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/mailbox/mailbox.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Inbox</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/mailbox/compose.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Compose</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/mailbox/read-mail.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Read</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-book"></i>
                          <p>
                              Pages
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/examples/invoice.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Invoice</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/profile.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Profile</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/e_commerce.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>E-commerce</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/projects.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Projects</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/project_add.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Add</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/project_edit.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Edit</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/project_detail.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Project Detail</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/contacts.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Contacts</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-plus-square"></i>
                          <p>
                              Extras
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/examples/login.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Login</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/register.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Register</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/lockscreen.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Lockscreen</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Legacy User Menu</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/language-menu.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Language Menu</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/404.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Error 404</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/500.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Error 500</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/examples/blank.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Blank Page</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="starter.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Starter Page</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">MISCELLANEOUS</li>
                  <li class="nav-item">
                      <a href="https://adminlte.io/docs/3.0" class="nav-link">
                          <i class="nav-icon fas fa-file"></i>
                          <p>Documentation</p>
                      </a>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-circle text-danger"></i>
                          <p class="text">Important</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-circle text-warning"></i>
                          <p>Warning</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon far fa-circle text-info"></i>
                          <p>Informational</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
