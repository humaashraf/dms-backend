<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            @can('dashboard')
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            @endcan
                            @can('donations')
                            <a class="nav-link" href="{{ url('/donations') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-heart"></i></div>
                                Donation
                            </a>
                            @endcan
                            @can('wire_transfers')
                            <a class="nav-link" href="{{ url('/wire-transfers') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-wifi"></i></div>
                                Wire Transfer
                            </a>
                            @endcan
                            @can('expenses')
                            <a class="nav-link" href="{{ url('/expenses') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Expenses
                            </a>
                            @endcan
                            @can('reports')
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-simple"></i></div>
                                Reports
                            </a>
                            @endcan
                            @can('user')
                            <a class="nav-link" href="{{ url('/users') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                User
                            </a>
                            @endcan
                            @can('bank_accounts')
                            <a class="nav-link" href="{{ url('/bank-accounts') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                                Bank Accounts
                            </a>
                            @endcan
                            @can('donation_categories')
                            <a class="nav-link" href="{{ url('/donation-categories') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-heart"></i></div>
                                Donation Categories
                            </a>
                            @endcan
                            @can('expense_categories')
                            <a class="nav-link" href="{{ url('/expense-categories') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                                Expense Categories
                            </a>
                            @endcan
                            @can('settings')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsesettings" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Settings
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @endcan
                            <div class="collapse" id="collapsesettings" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @can('general_settings')
                                    <a class="nav-link" href="{{ url('/general-settings/index/1') }}">General Settings</a>
                                    @endcan
                                    @can('email_settings')
                                    <a class="nav-link" href="{{ url('/email-settings/index/1') }}">Email Settings</a>
                                    @endcan
                                    @can('currencies')
                                    <a class="nav-link" href="{{ url('/currencies') }}">Manage Currency</a>
                                    @endcan
                                    @can('payment_methods')
                                    <a class="nav-link" href="{{ url('/payment-methods') }}">Payment Methods</a>
                                    @endcan
                                </nav>
                            </div>
                            {{-- <div class="sb-sidenav-menu-heading">Interface</div> --}}
                            @can('roles_and_permissions')
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-lock"></i></div>
                                Roles & Permissions
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            @endcan
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @can('roles')
                                    <a class="nav-link" href="{{ url('/roles') }}">Roles</a>
                                    @endcan
                                    @can('permissions')
                                    <a class="nav-link" href="{{ url('/permissions') }}">Permissions</a>
                                    @endcan
                                </nav>
                            </div>
                            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> --}}
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
