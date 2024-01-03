import React, { useState,useEffect  } from "react";
import { useNavigate } from "react-router-dom";
import Header from "../components/Header";
import Slider from "../components/home/Slider";
import Banner from "../components/home/Banner";
import ListProducts from "../components/ListProducts";
import Footer from "../components/Footer";
import {fetchAllProduct} from "../services/UserService";
export default function Home() {
  const [listProducts,setProducts] = useState([]);
  const navigate = useNavigate();
  useEffect(() => {
    //Demo rằng buột phải đăng nhập mới vào trang
    const token = localStorage.getItem('token');
    if (!token) {
      navigate('/login');
    }
    
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
        <Slider/>
        <Banner/>
        <ListProducts data={listProducts}/>
        <Footer/>
      </div>
    </>
  );
}
