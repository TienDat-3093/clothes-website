import {React,useRef} from "react";
import axios from "axios";
export default function EmailEdit() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    const input_email = useRef();
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
        var email = input_email.current.value;
        var id = user.id;
        const gmailRegex = /^[^\s@]+@gmail\.com$/;
        const isValid = gmailRegex.test(email);
        if(!isValid)
        return alert('Email is invalid \nEx: abc@gmail.com');
        try {
          const response = await axios.post(
            'http://127.0.0.1:8000/api/edit',
            { id,email },
            { headers: { 
                'Authorization': 'Bearer '+ token,
                'Accept': 'application/json',
            } }
          );
          alert(response.data.message);
          if(response.data.message != "New email is the same as current email")
            getUser();
        }catch(error){
            alert('Error: '+ error.response.data.message)
        }
    }
    return(
        <>
          <label>New Email</label><input type="text" name="email" ref={input_email} className="form-control border-input"></input>
          <button onClick={handleEdit}>Submit</button>
          </>
    )
}