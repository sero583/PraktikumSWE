import { useState } from 'react';
import { Link } from 'react-router-dom';
import '../../css/components/Header.css';
import UserIcon from './UserIcon';
import XpBar from './XpBar';

export default function Header(){
    const [token, setToken] = useState();
    let loggedIn = true;
    if(token) {
        loggedIn = true;
    }

    if(loggedIn){
        return (
            <div className="header">
                <Link to="/home">
                    <img width="60" height="60" src="images/logo512.png" alt="-LOGO-"></img>
                </Link>
                <XpBar></XpBar>
                <UserIcon></UserIcon>
            </div>
        );
    }
    else{
        return (
            <div className="header">
                <Link to="/home">
                    <img width="60" height="60" src="images/logo512.png" alt="-LOGO-"></img>
                </Link>
                <Link to="/login">
                    <div className='login'>
                        <p>Log in</p>
                    </div>
                </Link>
            </div>
        );
    }
}