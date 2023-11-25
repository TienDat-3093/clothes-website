import axios from "axios";

const fetchAllProduct =()=>{
    return axios.get('http://localhost:8000/api/product');
}

export {fetchAllProduct};

const fetchAllUser =()=>{
    return axios.get('http://localhost:8000/api/product');
}

export {fetchAllUser};