import axios from "axios";

const fetchAllProduct =()=>{
    return axios.get('http://localhost:8000/api/product/index');
}
export {fetchAllProduct};

const fetchDetail =(id)=>{
    return axios.get(`http://localhost:8000/api/product/show/${id}`);
}
export {fetchDetail};