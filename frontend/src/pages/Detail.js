import React, { useState,useEffect  } from "react";
import { useParams } from 'react-router-dom';
import Header from "../components/Header";
import ProductDetail from "../components/product_detail/ProductDetail";
import Footer from "../components/Footer";
import { fetchDetail } from "../services/UserService";

export default function Detail() {
  const { id } = useParams();
  const [detail,setDetail] = useState([]);
  
  
  const getDetail =async ()=>{
    
    
    try{
      let res = await fetchDetail(id);
      
    if(res && res.data && res.data.data)
    {
      const product = res.data.data;

      setDetail(product);
    }
    }catch (error) {
      console.error(error);
    }
    
  }
  useEffect(()=>{
    getDetail();
  },[id]);
  return (
    <>
      <div className="animsition">
        <Header />
        <ProductDetail props={detail}/>
        <Footer />
      </div>
    </>
  );
}
