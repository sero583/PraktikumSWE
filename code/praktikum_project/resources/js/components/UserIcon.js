import '../../css/components/UserIcon.css';
import { Link } from 'react-router-dom';
import React, { useState } from "react";
import "../../css/components/Modal.css";
export default function UserIcon() {

    //Testbeispiel für Pop-Up Fenster

    //state fängt false an weil sonst direkt popUp fenster zu sehen wäre bei Neuladen der Seite
    const [modal, setModal] = useState(false);

    //mit use-state wird das popUp component gezeigt/versteckt
    const toggleModal = () => {
        setModal(!modal);
    };

    if(modal) {
        document.body.classList.add('active-modal')
    } else {
        document.body.classList.remove('active-modal')
    }

    return (
        <div className="usericon">
            <Link to="/user">
                <img src="/images/userIcon.png" width="48px" height="48px" id="userIcon" ></img>  
            </Link>

            <button  id="logoutButton" onClick={toggleModal}>Logout</button>
            
            {modal && (
                <div className="modal">
                    <div onClick={toggleModal} className="overlay"></div>
                        <div className="modal-content">
                        <h2>You have successfully logged out.</h2>
                    <button className="close-modal" onClick={toggleModal}>
                        <Link to ="/">
                        Back to the landing page
                         </Link>
                    </button>
            </div>
        </div>
      )}
    </div>
    );
  }