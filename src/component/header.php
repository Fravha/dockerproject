<header>
    <nav class="navbar">
        <div id="menu-toggle" class="menu-toggle">&#9776;</div>
        <ul>
            <li><a href="#">Menu</a></li>
            <li><a href="#" id="openModal">Calendario</a></li>
                <div id="calendarModal" class="modal">
                    <div class="modal-content">
                    <span class="close">&times;</span>
                        <h2>Calendario</h2>
                        <!-- Aquí incluimos el componente del calendario -->
                        <?php include 'calendar.php'; ?>
                    </div>
                </div>  
        </ul>
        <form class="search-form" onsubmit="searchSite(event)">
            <input type="text" id="searchInput" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
        <ul>
            <li><a href="javascript:history.back()" id="btnVolver">Volver</a></li>
            <li><a href="#">Cerrar Sesión</a></li> 
        </ul>
    </nav>
</header>
<script src="script.js"></script>
