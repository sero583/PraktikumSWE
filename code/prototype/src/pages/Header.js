import { Link } from 'react-router-dom';
import './styles/Header.css';

export default function Header(){
    return (
        <div className="header">
            <Link to="/home">
                <img width="60" height="60" src="logo512.png" alt="-LOGO-"></img>
            </Link>
            <Link to="/login">
                <div className='login'>
                    <p>Log in</p>
                </div>
            </Link>
        </div>
    );
}