import axios from "axios";
const fetchAllProduct = () => {
    return axios.get('http://localhost:8000/api/product/index');
}
export { fetchAllProduct };

const fetchDetail = (id) => {
    return axios.get(`http://localhost:8000/api/product/show/${id}`);
}
export { fetchDetail };

const fetchAllComment = (id) => {
    return axios.get(`http://localhost:8000/api/comment/${id}`);
}
export { fetchAllComment };

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
export { fetchUserComment };

const fetchUserDetail = async (token) => {
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
export { fetchUserDetail };

const deleteUserComment = (id, token) => {
    return axios.delete(`http://localhost:8000/api/comment/${id}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
        }
    });
}
export { deleteUserComment };

const fetchUserCart = async (id, token) => {
    try {
        const response = await axios.get(`http://localhost:8000/api/cart/user/${id}`, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        });

        const userCart = response.data.carts;
        localStorage.setItem('cart', JSON.stringify(userCart));

        const userCartDetail = response.data.cart_details;
        localStorage.setItem('cartDetail', JSON.stringify(userCartDetail));
        console.log(userCart, userCartDetail);
        return true;
    } catch (error) {
        alert(error.response.data.message);
        return [];
    }
};
export { fetchUserCart };

const cancelUserCart = (id, token) => {
    return axios.delete(`http://localhost:8000/api/cart/${id}`, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json',
        }
    });
}
export { cancelUserCart };

const checkout = async (user_id, token, usercart) => {
    try {
        const response = await axios.post(`http://localhost:8000/api/cart/checkout`, {
            user_id,usercart
        }, {
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            }
        });

        if (response.data.success) {
            localStorage.removeItem('usercart');

            return true;
        } else {
            alert(response.data.message);
            return false;
        }
    } catch (error) {
        console.error(error);
        alert('An error occurred during checkout. Please try again.');
        return false;
    }
};
export { checkout };