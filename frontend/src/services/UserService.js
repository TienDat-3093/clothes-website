import axios from "axios";

const fetchAllProduct =()=>{
    return axios.get('http://localhost:8000/api/product/index');
}
export {fetchAllProduct};

const fetchDetail =(id)=>{
    return axios.get(`http://localhost:8000/api/product/show/${id}`);
}
export {fetchDetail};

const fetchAllProductType =()=>{
    return axios.get(`http://localhost:8000/api/producttype/index`);
}
export {fetchAllProductType};

const fetchProductToType =(id)=>{
    return axios.get(`http://localhost:8000/api/producttype/show/${id}`);
}
export {fetchProductToType};

const fetchAllCategories =()=>{
    return axios.get(`http://localhost:8000/api/category/index`);
}
export {fetchAllCategories};

const fetchProductToCategory =(id)=>{
    return axios.get(`http://localhost:8000/api/category/show/${id}`);
}
export {fetchProductToCategory};

const fetchAllComment =(id)=>{
    return axios.get(`http://localhost:8000/api/comment/${id}`);
}
export {fetchAllComment};

const fetchSlideShow =(id)=>{
    return axios.get(`http://localhost:8000/api/slideshow/index`);
}
export {fetchSlideShow};