import axios from "axios";
const fetchAllProduct =()=>{
    return axios.get('http://localhost:8000/api/product/index');
}
export {fetchAllProduct};

const fetchDetail =(id)=>{
    return axios.get(`http://localhost:8000/api/product/show/${id}`);
}
export {fetchDetail};

const fetchAllComment =(id)=>{
    return axios.get(`http://localhost:8000/api/comment/${id}`);
}
export {fetchAllComment};

const fetchUserComment = async (id, token) => {
    try {
      const response = await axios.get(`http://localhost:8000/api/comment/user/${id}`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Accept': 'application/json',
        }
      });
  
      const userComments = response.data.data;
      localStorage.setItem('comment', JSON.stringify(userComments));
  
      return userComments;
    } catch (error) {
      alert(error.response.data.message);
      return [];
    }
  };
export {fetchUserComment};

const fetchUserDetail = async (token)=>{
    try {
        const response = await axios.get(`http://localhost:8000/api/me`, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
          }
        });
    
        const user = response.data.user;
        localStorage.setItem('user', JSON.stringify(user));
    
        return user;
      } catch (error) {
        alert(error.response.data.message);
        return null;
      }
    };
export {fetchUserDetail};

const deleteUserComment =(id,token)=>{
    return axios.delete(`http://localhost:8000/api/comment/${id}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
        }
    });
}
export {deleteUserComment};