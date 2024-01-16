import React from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';
import CartDetail from '../components/cart/CartDetail';

export default function Cart() {
    return (
        <div>
            <Header />
            <CartDetail />
            <Footer />
        </div>
    )
}
