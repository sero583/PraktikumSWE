import {Link, useNavigate} from 'react-router-dom';
import { useEffect, useState, useRef } from 'react';
import '../../css/components/Account.css';

export default function Login() {
    const loginButton = useRef();
    const navigate = useNavigate();

    function handleLogIn() {
        if(loginButton.current.disabled===true) return;

        // get fields
        const email_input = document.getElementById("email");
        const password_input = document.getElementById("password");

        // check them client-side
        if(email_input.value === ""){
            email_input.classList.add("required");
            return;
        } else email_input.classList.remove("required");

        if(password_input.value === ""){
            password_input.classList.add("required");
            return;
        } else password_input.classList.remove("required");

        // now check them server-side/try to authenticate
        let body = {
            "email": email_input.value,
	        "password": password_input.value
        };

        loginButton.current.disabled = true;

        axios.post("/api/users/login", body).then((response) => {
            if(response) {
                if(response.data.success===true) {
                    // save token in browser now and use it for requests, which will be made later
                    window.localStorage.setItem("token", response.data.token);
                    // redirects to homepage, where react logic gets restarted
                    document.location.href = "/";
                } else alert("Invalid credentinals!");
            } else alert("Invalid response received!");

            loginButton.current.disabled = false;
        }).catch(function(error) {
            // TODO: make this cleaner
            alert("Invalid credentinals");
            loginButton.current.disabled = false;
        });
    }

    // listeners
    function registerKeydownListener() {
        const email_input = document.getElementById("email");
        const password_input = document.getElementById("password");

        email_input.addEventListener("keydown", checkEnterPress);
        password_input.addEventListener("keydown", checkEnterPress);
    }

    function checkEnterPress(event) {
        if(event.key==="Enter") {
            handleLogIn();
        }
    }

    return (
        <div className="account">
            <h1>Sign in to your account</h1>

            <div className="innerAccount">
                <label htmlFor='email'>Email:</label>
                <input onClick={registerKeydownListener} id="email" type="text" /*onBlur={handleUserBlur}*/></input>
                <label htmlFor="password">Password:</label>
                <input onClick={registerKeydownListener} id="password" type="password" /*onBlur={handlePassBlur}*/></input>
                <button ref={loginButton} type="submit" onClick={handleLogIn}>Sign in</button>
            </div>

            {/*<p><Link to="/forgotpassword">Forgot your password?</Link></p>*/}
            <p>Not signed up yet? <Link to="/register">Create an account</Link></p>
        </div>
    );
}