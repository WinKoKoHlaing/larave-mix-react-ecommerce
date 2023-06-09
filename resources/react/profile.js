import React from "react";
import { createRoot } from "react-dom/client";
import { HashRouter, Routes, Route, Link } from "react-router-dom";
import Cart from "./Profile/Cart";
import Profile from "./Profile/Profile";
import Order from "./Profile/Order";
import Nav from "./Profile/Nav/Nav";
import ChangePassword from "./Profile/ChangePassword";
const MainRouter = () => {
    return (
        <HashRouter>
            <Nav />
            <Routes>
                <Route path="/" element={<Cart />} />
                <Route path="/order-list" element={<Order />} />
                <Route path="/profile" element={<Profile />} />
                <Route
                    path="/change-password"
                    element={<ChangePassword />}
                ></Route>
            </Routes>
        </HashRouter>
    );
};

createRoot(document.getElementById("root")).render(<MainRouter />);
