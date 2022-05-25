import '../../css/components/UserIcon.css';
import { Link, useNavigate } from 'react-router-dom';
import React, { useState } from "react";
import "../../css/components/Modal.css";

export default function UserIcon(token) {
    // unwrap token
    token = token.receiveValue.receiveValue.receiveValue; // TODO: Find a better solution than this crap

    //Testbeispiel für Pop-Up Fenster

    // state fängt bei false an, weil sonst das popUp fenster direkt beim Starten der Seite sichtbar wäre
    const [modal, setModal] = useState(false);
    const navigate = useNavigate();
    //mit use-state wird das popUp component gezeigt/versteckt
    const toggleModal = () => {
        setModal(!modal);
    };


    function logOut() {
        if(!modal) {
            toggleModal();
        }
        // remove token from storage
        window.localStorage.removeItem("token");
        token = null;
    }

    function log() {
        if(token===undefined) {
            // logged out -> user wants to login
            logIn();
        } else {
            // logged in -> user wants to log out
            logOut();
        }
    }

    function logIn() {
        navigate("/login");
    }

    function backToLandingPage() {
        // navigate("/");
        toggleModal();
        // window.location.reload()
        document.location.href = "/";
    }


    /* redundant? if(modal) {
        document.body.classList.add('active-modal')
    } else {
        document.body.classList.remove('active-modal')
    }*/
    console.log("Show me token: " + token);
    console.log(token);

    /*
        Old code
            { token===undefined ?
                <button id="loginButton" onClick={log}>Login</button> :
                <button id="logoutButton" onClick={logOut}>Logout</button> }
                */

    return (
        <div className="usericon">
            <Link to="/user">
                <img src="/images/userIcon.png" width="48px" height="48px" id="userIcon" />  
            </Link>

            <button id="logButton" onClick={log}>{token===undefined ? "Login" : "Logout"}</button>
            
            {modal &&
            (<div className="modal">
                <div className="overlay"/>
                    <div className="modal-content">
                        <h2>You have been successfully logged out.</h2>
                        <button className="close-modal" onClick={backToLandingPage}>Back to the landing page</button>
                </div>
            </div>
            )}
        </div>
    );
  }