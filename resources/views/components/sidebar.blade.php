<div id="sidebar" class="sidebar bg-white shadow-sm p-3">
    <button id="toggleSidebar" class="btn w-100 mb-4 toggle-btn">
        <i class="bi bi-list"></i>
        <span class="menu-text ms-2">Menu</span>
    </button>

    <ul class="nav flex-column">

        <li class="nav-item mb-2">
            <a href="/dashboard" class="nav-link active">
                <i class="bi bi-speedometer2"></i>
                <span class="menu-text ms-2">Dashboard</span>
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="/users" class="nav-link">
                <i class="bi bi-people-fill"></i>
                <span class="menu-text ms-2">Users</span>
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="#" class="nav-link">
                <i class="bi bi-person-circle"></i>
                <span class="menu-text ms-2">Profile</span>
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="#" class="nav-link">
                <i class="bi bi-bell-fill"></i>
                <span class="menu-text ms-2">Notifications</span>
            </a>
        </li>


        <li class="nav-item mb-2">
            <a href="#" class="nav-link">
                <i class="bi bi-gear-fill"></i>
                <span class="menu-text ms-2">Settings</span>
            </a>
        </li>


        <hr>


        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="btn logout-btn w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="menu-text ms-2">Logout</span>
                </button>

            </form>
        </li>

    </ul>

</div>



<style>
    .sidebar {
        width: 260px;
        min-height: 100vh;
        transition: 0.3s ease;
        border-right: 1px solid #e5e7eb;
    }


    .sidebar.collapsed {
        width: 80px;
    }


    /* Hide text when collapsed */
    .sidebar.collapsed .menu-text {
        display: none;
    }


    /* Center icons */
    .sidebar.collapsed .nav-link,
    .sidebar.collapsed .logout-btn {
        justify-content: center;
        text-align: center;
    }


    /* Navigation links */
    .nav-link {
        display: flex;
        align-items: center;
        color: #303030;
        padding: 12px 15px;
        border-radius: 12px;
        transition: .2s;
        font-weight: 500;
    }


    /* ICON STYLE */
    .toggle-btn i {
        color: 	#303030;
        /* change icon color here */
        font-size: 20px;
    }

    /* hover color */
    .toggle-btn:hover i {
        color: #000;
    }


    /* Text hover */
    .nav-link:hover {
        background: #eff6ff;
        color: #000;
    }


    /* Active menu */
    .nav-link.active {
        background: white;
        color: black;
    }


    /* Active icon */
    .nav-link.active i {
        color: #000;
    }


    /* Toggle button */
    .toggle-btn {
        border-radius: 12px;
    }


    /* Logout */
    .logout-btn {
        color: #dc2626;
        padding: 12px 15px;
        border-radius: 12px;
        font-weight: 500;
    }


    /* Logout hover */
    .logout-btn:hover {
        background: #fee2e2;
    }


    /* collapsed button spacing */
    .sidebar.collapsed .toggle-btn {
        padding: 12px;
    }


    /* Keep collapsed icons centered */
    .sidebar.collapsed .nav-link i,
    .sidebar.collapsed .logout-btn i {
        margin: 0;
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const toggle = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");


        toggle.addEventListener("click", function() {

            sidebar.classList.toggle("collapsed");

        });

    });
</script>