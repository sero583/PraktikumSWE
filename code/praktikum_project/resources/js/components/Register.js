import {Link, useNavigate} from 'react-router-dom';
import '../../css/components/Account.css';

export default function Register(){
    const navigate = useNavigate();

    function handleRegister(){    
        const username_input = document.getElementById("username");
        username_input.classList.remove("required");
        const email_input = document.getElementById("email");
        email_input.classList.remove("required");
        const password_input = document.getElementById("password");
        password_input.classList.remove("required");
        if(username_input.value === ""){
            username_input.classList.add("required");
            return;
        }
        if(email_input.value === ""){
            email_input.classList.add("required");
            return;
        }
        if(password_input.value === ""){
            password_input.classList.add("required");
            return;
        }
        navigate("/home");
    }

    function handleUserBlur(){
        const username_input = document.getElementById("username");
        username_input.classList.remove("required");
        if(username_input.value === ""){
            username_input.classList.add("required");
        }
    }

    function handleEmailBlur(){
        const email_input = document.getElementById("email");
        email_input.classList.remove("required");
        if(email_input.value === ""){
            email_input.classList.add("required");
        }
    }

    function handlePassBlur(){
        const password_input = document.getElementById("password");
        password_input.classList.remove("required");
        if(password_input.value === ""){
            password_input.classList.add("required");
        }
    }
    
    return (
        <div className="account">
            <h1>Create your Account</h1>
            <div className='innerAccount'>
                <label htmlFor="username">Username:</label>
                <input id="username" type="text" onBlur={handleUserBlur}></input>
                <label htmlFor="email">Email:</label>
                <input id="email" type="email" onBlur={handleEmailBlur}></input>
                <label htmlFor="password">Password:</label>
                <input id="password" type="password" onBlur={handlePassBlur}></input>
                <button onClick={handleRegister}>Register</button>
            </div>
            <p>Already have an Account? <Link to="/login">Log in</Link></p>
        </div>
    );
}