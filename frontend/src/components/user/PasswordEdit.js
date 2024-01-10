import {React,useRef} from "react";
import axios from "axios";
export default function PasswordEdit() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    const input_password = useRef();
    const input_conf_password = useRef();
    const input_current_password = useRef();
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
        var current_password = input_current_password.current.value;
        var password = input_password.current.value;
        var conf_password = input_conf_password.current.value;
        var id = user.id;
        const passRegex = /^.{6,}$/;
        const isValid = passRegex.test(password);
        if(!isValid)
        return alert('Password must be at least 6 characters');
        if(conf_password != password)
        return alert('Confirm password does not match');
        try {
          const response = await axios.post(
            'http://127.0.0.1:8000/api/edit',
            { id,password,current_password },
            { headers: { 
                'Authorization': 'Bearer '+ token,
                'Accept': 'application/json',
            } }
          );
        if(response.data.message === "Current password is not correct")
            return alert(response.data.message);
        if(response.data.message === "New password is the same as current password")
            return alert(response.data.message);
        alert(response.data.message);
        getUser();
        }catch(error){
            alert('Error: '+ error.response.data.message)
        }
    }
    return(
        <>
            <label>Current Password</label><input type="text" name="current_password" ref={input_current_password} className="form-control border-input"></input>
            <label>New Password</label><input type="text" name="password" ref={input_password} className="form-control border-input"></input>
            <label>Confirm Password</label><input type="text" name="conf_password" ref={input_conf_password} className="form-control border-input"></input>
            <button onClick={handleEdit}>Submit</button>
        </>
    )
}