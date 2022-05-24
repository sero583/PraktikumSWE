import "../../css/components/ForgotPasswordSubmit.css";

export default function ForgotPasswordSubmit() {
    return (
        <div className="forgotPasswordSubmitContent">
            <h1>Email has been sent!</h1>
            <p>Check your inbox for further instructions on how to reset your password.</p>
            <br/>
            <p><strong>Note that when entering a wrong email address, no email will be sent.</strong></p>
        </div>
    ); 
}