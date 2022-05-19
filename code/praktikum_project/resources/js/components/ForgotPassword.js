import { useNavigate } from 'react-router-dom';
import '../../css/components/Account.css';


export default function ForgotPassword() {
    const navigate = useNavigate();

    function resetPassword() {
        const email = document.getElementById("emailOrUsername");

        // send request to server for reset
        console.log("Email or username: " + email != null ? "null" : email.textContent);

        //if(email!=null) {
            navigate("/forgotpasswordsubmit");
        //}
    }

    return (
        <div className="account">
            <h1>Forgot your password?</h1>

            <div className="innerAccount">
                <label>Email or Username:</label>
                <input id="emailOrusername"/>
                <button type="submit" onClick={resetPassword}>Reset password</button>
            </div>
        </div>
    );
}