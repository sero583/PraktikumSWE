import { useNavigate } from 'react-router-dom';
import '../../css/components/Account.css';


export default function ForgotPassword() {
    const navigate = useNavigate();

    function resetPassword() {
        const email = document.getElementById("email");

        // send request to server for reset
        console.log("Email: " + email != null ? "null" : email.textContent);

        //if(email!=null) {
            navigate("/forgotpasswordsubmit");
        //}
    }

    return (
        <div className="account">
            <h1>Forgot your password?</h1>

            <div className="innerAccount">
                <label>Email:</label>
                <input id="email"/>
                <button type="submit" onClick={resetPassword}>Reset password</button>
            </div>
        </div>
    );
}