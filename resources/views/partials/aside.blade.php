@php
use App\Models\Store;
use App\Models\Distribution;
$distributions = Distribution::all();
$stores = Store::all();
@endphp
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="overflow:auto">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('index') }}"
                        aria-expanded="false"><i class="mdi mdi-home"></i><span
                            class="hide-menu">Acceuil</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('product') }}"
                        aria-expanded="false"><i class="mdi mdi-glass-mug"></i><span
                            class="hide-menu">Produit</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('customer') }}"
                        aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span
                            class="hide-menu">Client</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Réseau de
                            distribution</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @if (count($distributions) > 0)
                            @foreach ($distributions as $distribution)
                                <li class="sidebar-item">
                                    <a href="{{ route('distribution.show', ['id' => $distribution->id]) }}"
                                        class="sidebar-link"><i class="mdi mdi-arrow-right-bold"></i><span
                                            class="hide-menu">
                                            @if ($distribution->name == 'RKIN')
                                                Réseau Kinshasa
                                            @elseif ($distribution->name == 'RHKIN')
                                                Réseau Hors Kinshasa
                                            @endif
                                        </span></a>
                                </li>
                            @endforeach
                        @else
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link"><i class="mdi mdi-glass-stange"></i><span
                                        class="hide-menu">Aucun réseau disponible</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-gas-station"></i><span
                            class="hide-menu">Dépot</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        @if (count($stores) > 0)
                            @foreach ($stores as $store)
                                <li class="sidebar-item">
                                    <a href="{{ route('store.show', ['id' => $store->id]) }}"
                                        class="sidebar-link"><i class="mdi mdi-arrow-right-bold"></i><span
                                            class="hide-menu">
                                            {{$store->name}}
                                        </span></a>
                                </li>
                            @endforeach
                        @else
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link"><i class="mdi mdi-glass-stange"></i><span
                                        class="hide-menu">Aucun dépot disponible</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false"><i class="mdi mdi-settings"></i><span
                            class="hide-menu">Paramètres</span></a>
                    <ul aria-expanded="false" class="collapse first-level" style="overflow:auto">
                        <li class="sidebar-item">
                            <a href="{{ route('personal') }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span
                                    class="hide-menu">Personnels</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('distribution') }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Réseau de
                                    distribution</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('store') }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span
                                    class="hide-menu">Dépot</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('category') }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span
                                    class="hide-menu">Catégorie</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('type') }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Types des
                                    produits</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('setting', ['name' => 'title']) }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Postes de
                                    travail</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('setting', ['name' => 'role']) }}" class="sidebar-link"><i
                                    class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Roles
                                    application </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
