import { React, useState } from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";
import UserInfo from "../components/user/UserInfo";
import MyOrders from "../components/user/MyOrders";
import MyRatings from "../components/user/MyRatings";
export default function Detail() {
    const [selectedMenu, setSelectedMenu] = useState("userInfo");
    return (
        <>
            <Header />
            <section className="bg0 p-t-104 p-b-116">
                <div className="container">
                    <div className="flex-w flex-tr">
                        <div style={{ width: "25%" }} className="p-lr-70 p-lr-15-lg w-full-md">
                            <button onClick={() => setSelectedMenu('userInfo')} style={{ border: "1px solid #e6e6e6", margin: "10px", padding: "10px", paddingTop: "10px", marginTop: "0px" }}>
                                User Infomations
                            </button>
                            <button onClick={() => setSelectedMenu('myOrders')} style={{ border: "1px solid #e6e6e6", margin: "10px", padding: "10px" }}>
                                My Orders
                            </button>
                            <button onClick={() => setSelectedMenu('myRatings')} style={{ border: "1px solid #e6e6e6", margin: "10px", padding: "10px" }}>
                                My Ratings
                            </button>
                        </div>
                        {selectedMenu === 'userInfo' && <UserInfo />}
                        {selectedMenu === 'myOrders' && <MyOrders />}
                        {selectedMenu === 'myRatings' && <MyRatings />}
                    </div>
                </div>
            </section>
            <Footer />
        </>
    );
}
