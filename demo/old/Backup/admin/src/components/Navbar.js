import React from 'react';
import "./Navbar.css";

const Navbar = () => {
    return (
        <div id="nav-container" className="bg-primary">
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <div className="container-fluid">
                    <div className="d-flex">
                        <a className="navbar-brand" href="#">
                            <img src="/admin/image/VTabicon.ico" alt="" width="30" height="24" className="d-inline-block align-text-top me-2" />
                            Vtab Square
                        </a>
                        <form className="d-flex">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="search-box">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="Search-box" />
                            </div>
                        </form>
                    </div>
                    <div>

                        <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li className="nav-item me-3">
                                <i class="fas fa-th-large nav-link"></i>
                            </li>
                            <li className="nav-item me-3">
                                <i class="fas fa-inbox nav-link"></i>
                            </li>
                            <li className="nav-item me-3">
                                <i class="far fa-bell nav-link"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    )
}

export default Navbar;
