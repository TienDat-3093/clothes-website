import React, { useState, useEffect } from "react";
import Header from "../components/Header";
import ListProducts from "../components/ListProducts";
import Footer from "../components/Footer";
import { fetchAllProduct, fetchProductToType } from "../services/UserService";
import { useParams } from "react-router-dom";
export default function Shop() {
    const { id } = useParams();
    console.log("id", id);
    const [listProducts, setProducts] = useState([]);
    const [productToType, setProductToType] = useState([]);
    useEffect(() => {
        getProduct();
        getProductToType();
    }, []);
    const getProduct = async () => {
        let res = await fetchAllProduct();
        if (res && res.data && res.data.data) {
            setProducts(res.data.data);
        }
    };

    const getProductToType = async () => {
        let res = await fetchProductToType(id);
        if (res && res.data && res.data.data) {
            const products = res.data.data;
            setProductToType(products);
        }
    };
    const handleProducts = () => {
        return id ? <ListProducts data={productToType} /> : <ListProducts data={listProducts} />;

    };
    return (
        <>
            <div className="animsition">
                <Header />
                {handleProducts()}
                <Footer />
            </div>
        </>
    );
}
