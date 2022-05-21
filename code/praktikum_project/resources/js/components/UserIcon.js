import '../../css/components/UserIcon.css';
export default function UserIcon() {
    //TODO make user icon with XP bar and logout button
    return (
        <div className="usericon">
            <img src="/images/userIcon.png" width="100px" height="100px" id="userIcon" ></img>   
            <button id="logoutButton">Logout</button>
        </div>
    );
  }