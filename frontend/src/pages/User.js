import React from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";

export default function Detail() {
    const user = JSON.parse(localStorage.getItem('user'));
    return (
        <>
            <div>
                <Header />
                <section className="sec-product-detail bg0 p-t-100 p-b-60">
                    <div className="container">
                        <div>
                            User Infomations
                        </div>
                        <form>
                            <div>
                                <div className="form-group">
                                    <label>Username</label>
                                    <input
                                        type="text"
                                        className="form-control border-input"
                                        disabled=""
                                        placeholder="Username"
                                        defaultValue={user.username}
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Fullname</label>
                                    <input
                                        type="text"
                                        className="form-control border-input"
                                        disabled=""
                                        placeholder="Fullname"
                                        defaultValue={user.fullname}
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Email</label>
                                    <input
                                        type="text"
                                        className="form-control border-input"
                                        disabled=""
                                        placeholder="Email"
                                        defaultValue={user.email}
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Password</label>
                                    <input
                                        type="text"
                                        className="form-control border-input"
                                        disabled=""
                                        placeholder="Password"
                                        defaultValue="***"
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Phone Number</label>
                                    <input
                                        type="text"
                                        className="form-control border-input"
                                        disabled=""
                                        placeholder="Phone Number"
                                        defaultValue={user.phone_number}
                                    />
                                </div>
                            </div>
                        </form></div>
                </section>
                <Footer />
            </div>
        </>
    );
}
