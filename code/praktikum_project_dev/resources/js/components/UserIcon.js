import '../../css/components/UserIcon.css';
import { Link, useNavigate } from 'react-router-dom';
import React, { useState } from "react";
import "../../css/components/Modal.css";

export default function UserIcon(token) {
    // unwrap token
    token = token.receiveValue;


    // state starts at false, so that the popUp window doesnt appear from the beginning
    const [modal, setModal] = useState(false);
    const navigate = useNavigate();
    // using use-state to show/hide the popUp window
    const toggleModal = () => {
        setModal(!modal);
    };


    function logOut() {
        if(!modal) {
            toggleModal();
        }
        // sending axios request to invalidate/"destroy" current token
        axios.get("/api/users/logout", {
        headers: { "Authorization": "Bearer " + window.localStorage.getItem("token") }
        }).then(function(response) {
            // ignore response
        }).catch(function (error) {
          console.log("Error during logout:");
          console.log(error);
        });
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