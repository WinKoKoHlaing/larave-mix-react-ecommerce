import React from "react";
import { Link, useLocation } from "react-router-dom";

function Nav() {
    const { pathname } = useLocation();
    // console.log(pathname);

    return (
        <div className="container-fluid mt-3">
            <div className="card bg-dark p-3 text-center">
                <div>
                    <Link
                        to="/"
                        className={`btn ${
                            pathname === "/"
                                ? "btn-warning"
                                : "btn-outline-warning"
                        }`}
                    >
                        Cart
                    </Link>
                    <Link
                        to="/order-list"
                        className={`btn ${
                            pathname === "/order-list"
                                ? "btn-warning"
                                : "btn-outline-warning"
                        }`}
                    >
                        Order List
                    </Link>
                    <Link
                        to="/profile"
                        className={`btn ${
                            pathname === "/profile"
                                ? "btn-warning"
                                : "btn-outline-warning"
                        }`}
                    >
                        Profile
                    </Link>
                    <Link
                        to="/change-password"
                        className={`btn ${
                            pathname === "/change-password"
                                ? "btn-warning"
                                : "btn-outline-warning"
                        }`}
                    >
                        Change Password
                    </Link>
                </div>
            </div>
        </div>
    );
}
export default Nav;
