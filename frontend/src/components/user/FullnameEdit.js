import {React,useRef} from "react";
import axios from "axios";
export default function FullnameEdit() {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    const input_fullname = useRef();
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
        var fullname = input_fullname.current.value;
        var id = user.id;
        try {
          const response = await axios.post(
            'http://127.0.0.1:8000/api/edit',
            { id,fullname },
            { headers: { 
                'Authorization': 'Bearer '+ token,
                'Accept': 'application/json',
            } }
          );
          alert(response.data.message);
          if(response.data.message != "New fullname is the same as current fullname")
            getUser();
        }catch(error){
            alert('Error: '+ error.response.data.message)
        }
    }
    return(
        <>
          <label>New Fullname</label><input type="text" name="fullname" ref={input_fullname} className="form-control border-input"></input>
          <button onClick={handleEdit}>Submit</button>
          </>
    )
}