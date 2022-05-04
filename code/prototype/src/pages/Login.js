import {Link, useNavigate} from 'react-router-dom';
import './styles/Account.css';

export default function Login(){
    const navigate = useNavigate();

    function handleLogIn(){    
        const username_input = document.getElementById("username");
        const password_input = document.getElementById("password");
        if(username_input.value === ""){
            username_input.classList.add("required");
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

    function handlePassBlur(){
        const password_input = document.getElementById("password");
        password_input.classList.remove("required");
        if(password_input.value === ""){
            password_input.classList.add("required");
        }
    }

    return (
        <div className="account">
            <h1>Log into your account</h1>
            <div className='innerAccount'>
                <label htmlFor='username'>Username:</label>
                <input id="username" type="text" onBlur={handleUserBlur}></input>
                <label htmlFor="password">Password:</label>
                <input id="password" type="password" onBlur={handlePassBlur}></input>
                <button type="submit" onClick={handleLogIn}>Sign in</button>       
            </div> 
            <p>Not signed up yet? <Link to="/register">Create an account</Link></p>
        </div>
    );
}