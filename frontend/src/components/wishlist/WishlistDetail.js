import React from 'react'
import { NavLink } from 'react-router-dom'
import { useState, useEffect } from 'react';

export default function WishlistDetail() {

    const [wishlist, setWishlist] = useState([]);

    const removeFromWishlist = (index) => {
        const newWishlist = [...wishlist];
        newWishlist.splice(index, 1);
        setWishlist(newWishlist);
    };


    return (
        <>
            <div className="bg0 p-t-145 p-b-85">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-10 col-xl-9 m-l-0 m-r-70">
                            <div>
                                <div className="wrap-table-shopping-cart">
                                    <table className="table-shopping-cart">
                                        <tbody>
                                            <tr className="table_head">
                                                <th className="column-1">Image</th>
                                                <th className="column-2">Product</th>
                                                <th className="column-3">Price</th>
                                                <th className="column-4">Quantity</th>
                                                <th className="column-5">Remove</th>
                                            </tr>

                                            {wishlist.map((item, index) => (
                                                <tr key={index} className="table_row">
                                                    <td className="column-1">
                                                        <div className="how-itemcart1">
                                                            <img src={item.image} alt="IMG" />
                                                        </div>
                                                    </td>
                                                    <td className="column-2">{item.productName}</td>
                                                    <td className="column-3">{item.price}</td>
                                                    <td className="column-4">
                                                        <div className="wrap-num-product flex-w m-l-auto m-r-0">
                                                            <input className="mtext-104 cl3 txt-center num-product" type="number" value={1} readOnly />
                                                        </div>
                                                    </td>
                                                    <td className="column-5">
                                                        <button className="btn-remove" onClick={() => removeFromWishlist(index)}>
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
                                        <input className="stext-104 cl2 plh4 size-117 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" />
                                        <div className=" stext-101 cl2 size-118  hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                        </div>
                                    </div>
                                    <NavLink to="/shop" className="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                        Continue Shopping
                                    </NavLink>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
