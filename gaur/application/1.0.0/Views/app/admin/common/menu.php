    <header class="container border-bottom mb-3 mt-md-2 pb-md-2">
        <div class="row align-items-center">
            <div class="col-md-3 d-none d-md-block">
                <div class="text-center">
                    <a href="" class="h4 mb-0">
                        <?= config('Config\App')->siteName ?>
                    </a>
                </div>
            </div>

            <nav class="col-md-9 g-menu">
                <input class="g-menu-state" id="menu-state" type="checkbox">

                <div class="g-menu-toggle">
                    <a href="" class="h4 mb-0">
                        <?= config('Config\App')->siteName ?>
                    </a>

                    <label class="g-menu-icon" for="menu-state"></label>
                </div>

                <ul class="g-main-menu">
                    <li>
                        <a href="admin/users">
                            <span class="fas fa-users"></span>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="admin/blogs">
                            <span class="fas fa-newspaper"></span>
                            Blogs
                        </a>
                    </li>
                    <li>
                        <a href="admin/services">
                            <span class="fas fa-newspaper"></span>
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="admin/photos">
                            <span class="fas fa-newspaper"></span>
                            Photos
                        </a>
                    </li>
                    <li>
                        <a href="admin/technologies">
                            <span class="fas fa-newspaper"></span>
                            Technologies
                        </a>
                    </li>
                    <li>
                        <span class="g-menu-item">
                            <span class="fas fa-cog"></span>
                            More
                        </span>
                        <ul class="g-sub-menu">
                            <li><a href="admin/clients">Clients</a></li>
                            <li><a href="admin/testimonials">Testimonials</a></li>
                            <li><a href="admin/teams">Teams</a></li>
                            <li><a href="admin/socialicons">Social Icons</a></li>
                            <li><a href="admin/slides">Slide</a></li>
                            <li><a href="admin/statistics">Statistics</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="account/logout">
                            <span class="fas fa-sign-out-alt"></span>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
