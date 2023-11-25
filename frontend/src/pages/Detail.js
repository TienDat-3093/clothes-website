import React from "react";
import Header from "../components/Header";
import ProductDetail from "../components/product/ProductDetail";
import Footer from "../components/Footer";
export default function Detail() {
  return (
    <>
      <div className="animsition">
        <Header />
        <ProductDetail/>
        <Footer />
      </div>
    </>
  );
}
