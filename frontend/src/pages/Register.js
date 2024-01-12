import { useRef } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
export default function Register(){
  const navigate = useNavigate();
  const fullname_input=useRef();
  const username_input=useRef();
  const email_input=useRef();
  const password_input=useRef();
  const address_input=useRef();
  const phone_number_input=useRef();
  const conf_password_input=useRef();
  const handleRegister = async () =>{
    var fullname = fullname_input.current.value;
    var username = username_input.current.value;
    var email = email_input.current.value;
    var password = password_input.current.value;
    var address = address_input.current.value;
    var phone_number = phone_number_input.current.value;
    var conf_password = conf_password_input.current.value;
    try {
      if(!address ||!username ||!email ||!password ||!conf_password ||!address ||!phone_number){
        return alert('Missing input fields');
      }

      const gmailRegex = /^[^\s@]+@gmail\.com$/;
      if(!gmailRegex.test(email))
        return alert('Email is invalid \nEx: abc@gmail.com');

      const passRegex = /^.{6,}$/;
      if(!passRegex.test(password))
        return alert('Password must be at least 6 characters');
      if(conf_password != password)
        return alert('Confirm password does not match');

      const phoneRegex = /^0\d{10}$/;
      if(!phoneRegex.test(phone_number))
        return alert('Phone number is invalid');

      const response = await axios.post(
        'http://127.0.0.1:8000/api/register',
        { fullname, username, email, password, address, phone_number },
        { headers: { 'Content-Type': 'application/json' } }
      );
      alert(response.data.message);
      navigate('/login');
    }catch(error){
      alert('Register failed: '+ error.response.data.message)
    }
  }
    return(<>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Adventure starts here 🚀</h4>
              <p class="mb-4">Register here</p>
                <div class="mb-3">
                  <label for="username" class="form-label">Fullname</label>
                  <input
                    type="text"
                    class="form-control"
                    id="fullname"
                    name="fullname"
                    placeholder="Enter your fullname"
                    autofocus
                    ref={fullname_input}
                  />
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    autofocus
                    ref={username_input}
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email"
                    ref={email_input} placeholder="Enter your email" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      ref={password_input}
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      ref={conf_password_input}
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <textarea class="form-control" id="address" name="address"
                    ref={address_input} placeholder="Enter your address" />
                </div>
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone</label>
                  <input type="number" class="form-control" id="phone_number" name="phone_number"
                    ref={phone_number_input} placeholder="Enter your phone number" />
                </div>
                <button onClick={handleRegister} class="btn btn-primary d-grid w-100">Sign up</button>

              <p class="text-center">
                <span>Already have an account? </span>
                <a href="/login">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</>);
}