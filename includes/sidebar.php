<div class="app-menu navbar-menu">
	<!-- LOGO -->
    <div class="navbar-brand-box">
    
        <!-- Light Logo-->
        <a href="../admin/dashboard.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../assets/images/logo-light.png" alt="" height="150">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
	
	<div id="scrollbar">
        <div class="container-fluid">
			<div id="two-column-menu"></div>
            	<ul class="navbar-nav" id="navbar-nav">
                	<li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    
    					
					<a class="nav-link menu-link" href="../admin/dashboard.php">
    					<i class="mdi mdi-speedometer"></i>
    					<span data-key="t-dashboards">Dashboard</span>
  					</a>
					<a class="nav-link menu-link" href="../customers/list.php">
    					<i class="mdi mdi-account-multiple"></i>
    					<span data-key="t-dashboards">Customer Management</span>
  					</a>

					<a class="nav-link menu-link" href="../products/list.php">
    					<i class="mdi mdi-package-variant"></i>
    					<span data-key="t-dashboards">Product Management</span>
  					</a>

					<li class="nav-item">
  						<a class="nav-link menu-link" href="#sidebarInvoices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
    						<i class="mdi mdi-file-document-outline"></i>
    						<span data-key="t-dashboards">Invoice Management</span>
  						</a>
  						<div class="collapse menu-dropdown" id="sidebarInvoices">
    						<ul class="nav nav-sm flex-column">
								<li class="nav-item">
									<a href="../invoices/create_invoice.php" class="nav-link" data-key="t-analytics">Create Invoice</a>
								</li>
								<li class="nav-item">
									<a href="../invoices/list.php" class="nav-link" data-key="t-crm">View Invoice</a>
								</li>
    						</ul>
  						</div>
					</li>
				</ul>
			</div>
			<!-- Sidebar -->
        </div>
		<div class="sidebar-background"></div>
    </div>
	<div class="vertical-overlay"></div>
        <!-- Left Sidebar End -->