import { useEffect, useState } from 'react';
import {Link, useNavigate} from 'react-router-dom';
import '../../css/components/Account.css';

export default function Register(){
    const navigate = useNavigate();
    const [isRegisterLoading, setRegisterLoading] = useState();
    const [errorMessage, setErrorMessage] = useState();

    function handleRegister() {
        // get fields
        const username_input = document.getElementById("username");
        const email_input = document.getElementById("email");
        const password_input = document.getElementById("password");
        const password_repeat_input = document.getElementById("password_repeat");

        // check if theyre empty
        if(username_input.value===""){
            username_input.classList.add("required");
            return;
        } else username_input.classList.remove("required");

        if(email_input.value===""){
            email_input.classList.add("required");
            return;
        } else email_input.classList.remove("required");

        if(password_input.value===""){
            password_input.classList.add("required");
            return;
        } else password_input.classList.remove("required");

        if(password_repeat_input.value===""){
            password_repeat_input.classList.add("required");
            return;
        } else password_repeat_input.classList.remove("required");
        
        let body = {
            "email": email_input.value,
	        "password": password_input.value,
	        "password_confirmation": password_repeat_input.value,
	        "name": username_input.value
        };

        axios.post('/api/users/register', body).then((response) => {
            if(response) {
                if(response.data.success===true) {
                    // save token in browser now and use it for requests, which will be made later
                    window.localStorage.setItem("token", response.data.token);

                    navigate("/home");
                } else setErrorMessage(response.data.message);
            } else setErrorMessage("Server is offline. Contact admin for fix.");
        }).catch(function(error) {
            let messages = error.response.data.message;
            
            if(messages) {
                let serverMessages = "";
                let lineberakChar = "\n";

                for(var key in messages) {
                    serverMessages += (key + ": " + messages[key] + lineberakChar); 
                }
                // cut off last linebreak with substring
                setErrorMessage(serverMessages.substring(0, serverMessages.length-lineberakChar.length)); 
            } else setErrorMessage("Server did not send a message");
        });
    }

    return (
        <div className="account">
            <h1>Create your Account</h1>
            <div className='innerAccount'>
                <label htmlFor="username">Username:</label>
                <input id="username" type="text" />
                <label htmlFor="email">Email:</label>
                <input id="email" type="email" />
                <label htmlFor="password">Password:</label>
                <input id="password" type="password" />
                <label htmlFor="password">Repeat password:</label>
                <input id="password_repeat" type="password" />

                { errorMessage && <br/>}
                { errorMessage && <div className="serverError"><p className="dynamicNewLine">{errorMessage}</p></div> }

                <button onClick={handleRegister}>Register</button>
            </div>
            <p>Already have an account? <Link to="/login">Sign in</Link></p>
        </div>
    );
}