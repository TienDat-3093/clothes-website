import {React,useRef} from "react";
import axios from "axios";
export default function PhoneNumberEdit() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    const input_phone_number = useRef();
    const getUser = async () => {
        const user = await axios.get(
            'http://127.0.0.1:8000/api/me',{
              headers: { 
                'Authorization': 'Bearer '+ token,
                'Accept': 'application/json',
              }
            }
          );
          localStorage.removeItem('user');
          localStorage.setItem('user', JSON.stringify(user.data.user));
          window.location.reload();
    };
    const handleEdit = async () => {
        var phone_number = input_phone_number.current.value;
        var id = user.id;
        const phoneRegex = /^0\d{10}$/;
        const isValid = phoneRegex.test(phone_number);
        if(!isValid)
        return alert('Phone number is invalid');
        try {
          const response = await axios.post(
            'http://127.0.0.1:8000/api/edit',
            { id,phone_number },
            { headers: { 
                'Authorization': 'Bearer '+ token,
                'Accept': 'application/json',
            } }
          );
          alert(response.data.message);
          if(response.data.message != "New phone_number is the same as current phone_number")
            getUser();
        }catch(error){
            alert('Error: '+ error.response.data.message)
        }
    }
    return(
        <>
          <label>New Phone Number</label><input type="number" name="phone_number" ref={input_phone_number} className="form-control border-input"></input>
          <button onClick={handleEdit}>Submit</button>
          </>
    )
}