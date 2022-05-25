import { useState } from 'react';
import { Link } from 'react-router-dom';
import '../../css/components/Header.css';
import UserIcon from './UserIcon';
import XpBar from './XpBar';

export default function Header(token) {
    if(token!==null) {
        return (
            <div className="header">
                <Link to="/home">
                    <img width="60" height="60" src="images/logo512.png" alt="-LOGO-"/>
                </Link>
                <XpBar/>
                <UserIcon receiveValue={token}/>
            </div>
        );
    }
    else{
        return (
            <div className="header">
                <Link to="/home">
                    <img width="60" height="60" src="images/logo512.png" alt="-LOGO-"/>
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