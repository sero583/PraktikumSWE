import '../../css/components/UserIcon.css';
import { Link } from 'react-router-dom';
export default function UserIcon() {
    //TODO make user icon with XP bar and logout button
    return (
        <div className="usericon">
            <Link to="/user">
                <img src="/images/userIcon.png" width="48px" height="48px" id="userIcon" ></img>  
            </Link>
            <Link to ="/">
            <button id="logoutButton">Logout</button>
            </Link>
        </div>
    );
  }