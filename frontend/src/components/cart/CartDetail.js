import React from 'react';
import { useState, useEffect } from 'react';
import { NavLink } from 'react-router-dom';
import { checkout,fetchUserCart } from '../../services/UserService';

export default function CartDetail() {

    const [usercart, setCart] = useState([]);

    useEffect(() => {
        const storedCart = JSON.parse(localStorage.getItem("usercart")) || [];

        const updatedCart = storedCart.map(item => ({
            ...item,
            quantity: item.quantity || 1,
        }));

        setCart(updatedCart);
    }, []);
    console.log(usercart);

    const updateCart = updatedCart => {
        localStorage.setItem('usercart', JSON.stringify(updatedCart));
        setCart(updatedCart);
    };

    const calculateSubtotal = () => {
        return usercart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);
    };

    const removeFromCart = index => {
        const updatedCart = [...usercart];
        updatedCart.splice(index, 1);
        updateCart(updatedCart);
    };

    const handleChangeQuantity = (index, newQuantity) => {
        newQuantity = Math.max(1, newQuantity);

        const updatedCart = [...usercart];
        updatedCart[index].quantity = newQuantity;
        updateCart(updatedCart);
    };
    const handleCheckout = async () => {
        const token = localStorage.getItem('token');
        const user = JSON.parse(localStorage.getItem('user'));
        console.log(token);
        console.log(user);
        if (!token || !user) {
            return alert("Vui lòng đăng nhập để thanh toán!");
        }

        try {
            const success = await checkout(user.id, token, usercart);

            if (success) {
                alert('Đặt hàng thành công!');
                await fetchUserCart(user.id,token);
                updateCart([]);
            }
        } catch (error) {
            console.error(error);
            alert('Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
        }
    };

    // const handleCheckout = async () => {
    //     const token = localStorage.getItem('token');
    //     const user = JSON.parse(localStorage.getItem('user'));

    //     if (!token || !user) {
    //         return alert("Vui lòng đăng nhập để thanh toán!");
    //     }

    //     try {
    //         const success = await checkout(user.id, token, usercart);

    //         if (success) {
    //             alert('Đặt hàng thành công');
    //         }
    //     } catch (error) {
    //         console.error(error);
    //         alert('Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
    //     }
    // };

    return (
        <>
            <div className="bg0 p-t-145 p-b-85">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-10 col-xl-8 m-l-0 m-r-70">
                            <div className="m-l-5 m-r--80 m-r-5">
                                <div className="wrap-table-shopping-cart">
                                    <table className="table-shopping-cart">
                                        <tbody>
                                            <tr className="table_head text-center">
                                                <th className="column-0">Images</th>
                                                <th className="column-0">Product</th>
                                                <th className="column-3">Price</th>
                                                <th className="column-3">Color</th>
                                                <th className="column-3">Size</th>
                                                <th className="column-3">Quantity</th>
                                                <th className="column-5">Total</th>
                                                <th className="column-5">Remove</th>
                                            </tr>
                                            {usercart.map((item, index) => (
                                                <tr key={index} className="table_row">
                                                    <td className="column-1">
                                                        <div className="how-itemcart1">
                                                            <img src={"http://localhost:8000/" + item.image.url} alt="IMG" />

                                                        </div>
                                                    </td>
                                                    <td className="column-3" style={{ textAlign: "center" }} >{item.name}</td>
                                                    <td className="column-4" style={{ textAlign: "center" }}>{item.price}</td>
                                                    <td className="column-3" style={{ textAlign: "center" }}>{item.colors_name}</td>
                                                    <td className="column-3" style={{ textAlign: "center" }}>{item.sizes_name}</td>

                                                    <td className="column-4">
                                                        <div className="wrap-num-product flex-w m-l-auto m-r-0">
                                                            <div
                                                                className="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                                                onClick={() =>
                                                                    handleChangeQuantity(index, item.quantity - 1)
                                                                }
                                                            >
                                                                <i className="fs-16 zmdi zmdi-minus" />
                                                            </div>
                                                            <input
                                                                className="mtext-104 cl3 txt-center num-product"
                                                                type="number"
                                                                name={`num-product${index}`}
                                                                value={item.quantity}
                                                                readOnly
                                                                onChange={(e) =>
                                                                    handleChangeQuantity(index, e.target.value)
                                                                }
                                                            />
                                                            <div
                                                                className="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                                                onClick={() =>
                                                                    handleChangeQuantity(index, item.quantity + 1)
                                                                }
                                                            >
                                                                <i className="fs-16 zmdi zmdi-plus" />
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td className="column-5">{item.price * item.quantity}</td>
                                                    <td className="column-5">
                                                        <button
                                                            onClick={() => removeFromCart(index)}
                                                            className="btn btn-sm btn-icon"
                                                        >
                                                            X
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                                <div className="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                                    <div className="flex-w flex-m m-r-20 m-tb-5">
                                        <input
                                            className="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                                            type="text"
                                            name="coupon"
                                            placeholder="Coupon Code"
                                        />
                                        <div className="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                            Apply coupon
                                        </div>
                                    </div>
                                    <NavLink to="/shop" className="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                        Continue Shopping
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                        <div className="col-5 col-xl-3 m-l-35 m-r-5">
                            <div className="bor10 p-lr-30 p-t-20 p-b-40 m-r-5">
                                <h4 className="mtext-109 cl2 p-b-30">Cart Totals</h4>
                                <div className="flex-w flex-t bor12 p-b-13">
                                    <div className="size-208">
                                        <span className="stext-110 cl2">Subtotal:</span>
                                    </div>
                                    <div className="size-209">
                                        <span className="mtext-110 cl2">{calculateSubtotal()} VND</span>
                                    </div>
                                </div>
                                <div className="flex-w flex-t bor12 p-t-15 p-b-30">
                                    <div className="size-208 w-full-ssm">
                                        <span className="stext-110 cl2">Shipping:</span>
                                    </div>
                                    <div className="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                        <p className="stext-111 cl6 p-t-2">
                                            There are no shipping methods available. Please double
                                            check your address, or contact us if you need any help.
                                        </p>
                                    </div>
                                </div>
                                <div className="flex-w flex-t p-t-27 p-b-33">
                                    <div className="size-208">
                                        <span className="mtext-101 cl2">Total:</span>
                                    </div>
                                    <div className="size-209 p-t-1">
                                        <span className="mtext-110 cl2">{calculateSubtotal()} VND</span>
                                    </div>
                                </div>
                                <button
                                    onClick={handleCheckout}
                                    className="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                                >
                                    Proceed to Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div >
        </>
    );
}
