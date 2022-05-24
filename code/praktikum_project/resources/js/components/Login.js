import {Link, useNavigate} from 'react-router-dom';
import '../../css/components/Account.css';

export default function Login(){
    //ressource for login
    //https://www.digitalocean.com/community/tutorials/how-to-add-login-authentication-to-react-applications
    
    const navigate = useNavigate();

    function handleLogIn(){
        // get fields
        const username_input = document.getElementById("username");
        const password_input = document.getElementById("password");

        // check them client-side
        if(username_input.value === ""){
            username_input.classList.add("required");
            return;
        } else username_input.classList.remove("required");

        if(password_input.value === ""){
            password_input.classList.add("required");
            return;
        } else password_input.classList.remove("required");

        // now check them server-side/try to authenticate
        

        navigate("/home");
    }
    
    
    /*function handleUserBlur(){
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
    }*/

    return (
        <div className="account">
            <h1>Sign in to your account</h1>

            <div className="innerAccount">
                <label htmlFor='username'>Username:</label>
                <input id="username" type="text" /*onBlur={handleUserBlur}*/></input>
                <label htmlFor="password">Password:</label>
                <input id="password" type="password" /*onBlur={handlePassBlur}*/></input>
                <button type="submit" onClick={handleLogIn}>Sign in</button>
            </div>

            <p><Link to="/forgotpassword">Forgot your password?</Link></p>
            <p>Not signed up yet? <Link to="/register">Create an account</Link></p>
        </div>
    );
}