
import React, { useState,useEffect  } from "react";
import Header from "../components/Header";
import ListProducts from "../components/ListProducts";
import Footer from "../components/Footer";
import {fetchAllProduct} from "../services/UserService";
export default function Shop() {
  const [listProducts,setProducts] = useState([]);
  useEffect(() => {
    //getUser();
    getProduct();
  }, []);
  const getProduct  =async()=>{
    let res = await fetchAllProduct();

    if(res && res.data && res.data.data)
    {
      setProducts(res.data.data);
    }
  }
  return (
    <>
      <div className="animsition">
        <Header />
        <ListProducts data={listProducts}/>
        <Footer />
      </div>
    </>
  );
}
