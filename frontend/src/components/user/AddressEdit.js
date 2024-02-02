import { React, useRef } from "react";
import axios from "axios";
export default function AddressEdit() {
  const token = localStorage.getItem('token');
  const user = JSON.parse(localStorage.getItem('user'));
  const input_address = useRef();
  const getUser = async () => {
    const user = await axios.get(
      'http://127.0.0.1:8000/api/me', {
      headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json',
      }
    }
    );
    localStorage.removeItem('user');
    localStorage.setItem('user', JSON.stringify(user.data.user));
    window.location.reload();
  };
  const handleEdit = async () => {
    var address = input_address.current.value;
    var id = user.id;
    if (!address) {
      return alert('Missing input fields');
    }
    try {
      const response = await axios.post(
        'http://127.0.0.1:8000/api/edit',
        { id, address },
        {
          headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
          }
        }
      );
      alert(response.data.message);
      if (response.data.message != "New address is the same as current address")
        getUser();
    } catch (error) {
      alert('Error: ' + error.response.data.message)
    }
  }
  return (
    <>
      <label>New Address</label><textarea name="address" ref={input_address} className="form-control border-input"></textarea>
      <button onClick={handleEdit}>Confirm</button>
    </>
  )
}