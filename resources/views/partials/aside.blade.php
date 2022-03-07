<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav" class="pt-4">
            <li class="sidebar-item">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('index') }}"
                aria-expanded="false"
                ><i class="mdi mdi-home"></i
                ><span class="hide-menu">Acceuil</span></a
              >
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('product') }}"
                aria-expanded="false"
                ><i class="mdi mdi-glass-mug"></i
                ><span class="hide-menu">Produit</span></a
              >
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('personal') }}"
                aria-expanded="false"
                ><i class="mdi mdi-account-multiple"></i
                ><span class="hide-menu">Personnel</span></a
              >
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('customer') }}"
                aria-expanded="false"
                ><i class="mdi mdi-account-multiple-plus"></i
                ><span class="hide-menu">Client</span></a
              >
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{ route('distribution') }}"
                aria-expanded="false"
                ><i class="mdi mdi-blur-linear"></i
                ><span class="hide-menu">Réseau de distribution</span></a
              >
            </li>
            <li class="sidebar-item">
              <a
                class="sidebar-link has-arrow waves-effect waves-dark"
                href="javascript:void(0)"
                aria-expanded="false"
                ><i class="mdi mdi-gas-station"></i
                ><span class="hide-menu">Dépot</span></a
              >
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="{{ route('store',['name'=>'Kingabwa']) }}" class="sidebar-link"
                    ><i class="mdi mdi-glass-stange"></i
                    ><span class="hide-menu">Kingabwa </span></a
                  >
                </li>
              </ul>
      </nav>
      <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
  </aside>
