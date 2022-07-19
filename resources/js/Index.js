import React from "react";
import ReactDOM from "react-dom/client";
import { useState, useEffect } from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Navbar from "./Components/Navbar";
import Login from "./Pages/Login";
import Home from "./Pages/Home";
import Register from "./Pages/Register";
import Article from "./Components/Article";
import Browse from "./Components/Browse";
import Category from "./Components/Category";
function Index() {
    const [isLoggedIn, setisLoggedIn] = useState(isLoggedIn || false);
    const [user, setUser] = useState({});
    const [token, setToken] = useState({});

    useEffect(() => {
        if (localStorage.getItem("loggedIn")) {
            setisLoggedIn(JSON.parse(localStorage.getItem("loggedIn")));
        }

        if (localStorage.getItem("user")) {
            setUser(JSON.parse(localStorage.getItem("user")));
        }
        if (localStorage.getItem("token")) {
            setToken(JSON.parse(localStorage.getItem("token")));
        }
    }, []);
    useEffect(() => {
        localStorage.setItem("loggedIn", isLoggedIn);
    }, [isLoggedIn]);

    return (
        <div className="index">
            <Navbar
                isLoggedIn={isLoggedIn}
                user={user}
                token={token}
                setisLoggedIn={setisLoggedIn}
            />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route
                    path="login"
                    element={<Login setisLoggedIn={setisLoggedIn} />}
                />
                <Route path="browse" element={<Browse />} />
                <Route path="register" element={<Register />} />
                <Route path="category" element={<Category />} />
                <Route path="articles/:id" element={<Article />} />
            </Routes>
        </div>
    );
}

export default Index;

if (document.getElementById("app")) {
    ReactDOM.createRoot(document.getElementById("app")).render(
        <BrowserRouter>
            <Index />
        </BrowserRouter>
    );
}
