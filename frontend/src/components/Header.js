import React, { useEffect, useRef, useState } from "react";
import { NavLink } from "react-router-dom";
import { useNavigate } from "react-router-dom";
import { fetchAllProductType } from "../services/UserService";
import $ from "jquery";
import axios from "axios";
export default function Header() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    const navigate = useNavigate();
    const handleLogout = async () => {
        try {
            const response = await axios.post(
                'http://127.0.0.1:8000/api/logout',
                {},
                {
                    headers: {
                        Authorization: 'Bearer ' + token,
                        Accept: 'application/json',
                    },
                });
            if (response.data.message == "Successfully logged out") {
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                localStorage.removeItem('comment');
                localStorage.removeItem('cart');
                localStorage.removeItem('cartDetail');
                localStorage.removeItem('usercart');
                navigate('/');
            }
        } catch (error) {
            console.log(error);
            if (error.response.data.message == "Token has expired") {
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                localStorage.removeItem('comment');
                localStorage.removeItem('cart');
                localStorage.removeItem('cartDetail');
                localStorage.removeItem('usercart');
                navigate('/');
            }
            console.log('Error during logout:', error.response.data.message);
        }
    };
    const menuDesktopRef = useRef(null);
    const wrapMenuDesktopRef = useRef(null);
    const [originalTop, setOriginalTop] = useState(0);

    useEffect(() => {
        getProductType();
        const menuDesktop = menuDesktopRef.current;
        const wrapMenuDesktop = wrapMenuDesktopRef.current;

        if (!menuDesktop || !wrapMenuDesktop) {
            return;
        }

        setOriginalTop(menuDesktop.offsetTop);

        const handleScroll = () => {
            let scrollPos = window.scrollY;

            if (scrollPos > originalTop) {
                menuDesktop.classList.add("fix-menu-desktop");
                wrapMenuDesktop.style.top = "0";
            } else {
                menuDesktop.classList.remove("fix-menu-desktop");
                wrapMenuDesktop.style.top = "40px";
            }
        };

        // Initial setup
        handleScroll();

        // Add scroll event listener
        window.addEventListener("scroll", handleScroll);

        // Clean up the event listener when the component unmounts
        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, [originalTop]);
    const [productType, setProductType] = useState([]);
    const getProductType = async () => {
        try {
            let res = await fetchAllProductType();

            if (res && res.data && res.data.data) {
                const product_type = res.data.data;
                setProductType(product_type);
            }
        } catch (error) {
            console.error(error);
        }
    };
    const getShop = () => {
        let type = [];
        if (Array.isArray(productType)) {
            type = productType.map(function (item, index) {
                return (
                    <li>
                        <a href={`/shop/${index + 1}`}>{item.name}</a>
                    </li>
                );
            });
            return type;
        }
    };

    return (
        <>
            <header>
                {/* Header desktop */}
                <div ref={menuDesktopRef} className="container-menu-desktop">
                    {/* Topbar */}
                    <div className="top-bar">
                        <div className="content-topbar flex-sb-m h-full container">
                            <div className="left-top-bar">Welcome to our clothes website</div>
                            <div className="right-top-bar flex-w h-full">
                                <a href="#" className="flex-c-m trans-04 p-lr-25">
                                    Help &amp; FAQs
                                </a>
                                {!token ? (
                                    <>
                                        <NavLink to="/login" className="flex-c-m trans-04 p-lr-25">
                                            Login
                                        </NavLink>
                                    </>
                                ) : null}
                                {token ? (
                                    <>
                                        <NavLink to="/user" className="flex-c-m trans-04 p-lr-25">
                                            {user.username}
                                        </NavLink>
                                        <a
                                            href="#"
                                            className="flex-c-m trans-04 p-lr-25"
                                            onClick={handleLogout}
                                        >
                                            Logout
                                        </a>
                                    </>
                                ) : null}
                            </div>
                        </div>
                    </div>
                    <div ref={wrapMenuDesktopRef} className="wrap-menu-desktop">
                        <nav className="limiter-menu-desktop container">
                            <NavLink to="/" className="logo">
                                <img src="../images/icons/logo-01.png" alt="IMG-LOGO" />
                            </NavLink>

                            <div className="menu-desktop">
                                <ul className="main-menu">
                                    <li className="">
                                        <NavLink to="/">Home</NavLink>
                                    </li>

                                    <li className="">
                                        <a href="/shop">Shop</a>
                                        <ul className="sub-menu">{getShop()}</ul>
                                    </li>

                                    {/* <li className="">
                    <NavLink to="/features">Features</NavLink>
                  </li> */}
                                    <li className="">
                                        <NavLink to="/blog">Blog</NavLink>
                                    </li>
                                    <li className="">
                                        <NavLink to="/about">About</NavLink>
                                    </li>
                                    <li className="">
                                        <NavLink to="/contact">Contact</NavLink>
                                    </li>
                                </ul>
                            </div>

                            <div className="wrap-icon-header flex-w flex-r-m">
                                <NavLink
                                    to="/cart"
                                    className="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                                    data-notify={2}
                                >
                                    <i className="zmdi zmdi-shopping-cart" />
                                </NavLink>
                                <NavLink
                                    to="/wishlist"
                                    className="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                                    data-notify={0}
                                >
                                    <i className="zmdi zmdi-favorite-outline" />
                                </NavLink>
                            </div>
                        </nav>
                    </div>
                </div>

                <div className="wrap-header-mobile">
                    <div className="logo-mobile">
                        <NavLink to="/">
                            <img src="../images/icons/logo-01.png" alt="IMG-LOGO" />
                        </NavLink>
                    </div>

                    <div className="wrap-icon-header flex-w flex-r-m m-r-15">
                        <div className="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                            <i className="zmdi zmdi-search" />
                        </div>
                        <NavLink
                            to="/cart"
                            className="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                            data-notify={2}
                        >
                            <i className="zmdi zmdi-shopping-cart" />
                        </NavLink>
                        <NavLink
                            to="/wishlist"
                            className="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                            data-notify={0}
                        >
                            <i className="zmdi zmdi-favorite-outline" />
                        </NavLink>
                    </div>

                    <div className="btn-show-menu-mobile hamburger hamburger--squeeze">
                        <span className="hamburger-box">
                            <span className="hamburger-inner" />
                        </span>
                    </div>
                </div>

                <div className="menu-mobile">
                    <ul className="topbar-mobile">
                        <li>
                            <div className="left-top-bar">Welcome to our clothes website</div>
                        </li>
                        <li>
                            <div className="right-top-bar flex-w h-full">
                                <a href="#" className="flex-c-m p-lr-10 trans-04">
                                    Help &amp; FAQs
                                </a>

                                {!token ? (
                                    <>
                                        <NavLink to="/login" className="flex-c-m trans-04 p-lr-25">
                                            Login
                                        </NavLink>
                                    </>
                                ) : null}
                                {token ? (
                                    <>
                                        <a href="user" className="flex-c-m trans-04 p-lr-25">
                                            {user.username}
                                        </a>
                                        <a
                                            href="#"
                                            className="flex-c-m trans-04 p-lr-25"
                                            onClick={handleLogout}
                                        >
                                            Logout
                                        </a>
                                    </>
                                ) : null}
                            </div>

                            <div className="modal-search-header flex-c-m trans-04 js-hide-modal-search">
                                <div className="container-search-header">
                                    <button className="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                                        <img src="../images/icons/icon-close2.png" alt="CLOSE" />
                                    </button>
                                    <div className="wrap-search-header flex-w p-l-15">
                                        <button className="flex-c-m trans-04">
                                            <i className="zmdi zmdi-search" />
                                        </button>
                                        <input
                                            className="plh3"
                                            type="text"
                                            name="search"
                                            placeholder="Search..."
                                        />
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
        </>
    );
}
