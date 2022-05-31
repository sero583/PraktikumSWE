import '../../css/components/UserPage.css';
import ReactDOM from 'react-dom';
import { useEffect, useState } from 'react';
import axios from 'axios';

export default function UserPage() {
    const [userData, setUserData] = useState(null);

    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");
        
        axios.get("/api/users/view-profile", {
            headers: { "Authorization": "Bearer " + cachedToken }
          }).then(function(response) {
            console.log(response);

            if(response&&response.status===200) {
              setUserData(response.data.data);
            } else alert("Couldn't load user data.");
          }).catch(function(error) {
              // invalid token -> delete and return false
              console.log("Error during loading user data.");
              console.log(error);
          });
      }, []);

    if(userData==null) {
        return (
            <div/>
        )
    } else {
        return (
            <div className="userpage">
                <h1>User page</h1>
                <div className="outerDiv">
                    <div className="accountInfo">
                        <h2>Account information</h2>
                        <label htmlFor="username">Username</label><br></br>
                        <input type="text" id="username" value={userData.name} placeholder="Loading..." readOnly="readonly"></input><br></br>
                        
                        <label htmlFor="email">Email</label><br></br>
                        <input type="text" id="email" value={userData.email} placeholder="Loading..." readOnly="readonly"></input><br></br>
                    </div>

                    <div className="courseProgress">
                        <h2>Course Progress</h2>

                        <label htmlFor="completedCourses">Completed courses</label>
                        <div className="wrapperCompleted">
                            <div className="completedItem">Course-1</div>
                            <div className="completedItem">Course-2</div>
                            <div className="completedItem">Course-3</div>
                            <div className="completedItem">Course-4</div>
                            <div className="completedItem">Course-5</div>
                            <div className="completedItem">Course-6</div>
                            <div className="completedItem">Course-7</div>
                            <div className="completedItem">Course-8</div>
                            <div className="completedItem">Course-9</div>
                            <div className="completedItem">Course-10</div>
                        </div>
                        <br></br>
                        <br></br>
                        <br></br>
                        <label htmlFor="startedCourses">Started courses</label>
                        <div className="wrapperStarted">
                            <div className="startedItem">Course-1</div>
                            <div className="startedItem">Course-2</div>
                            <div className="startedItem">Course-3</div>
                            <div className="startedItem">Course-4</div>
                            <div className="startedItem">Course-5</div>
                            <div className="startedItem">Course-6</div>
                            <div className="startedItem">Course-7</div>
                            <div className="startedItem">Course-8</div>
                            <div className="startedItem">Course-9</div>
                            <div className="startedItem">Course-10</div>
                        </div>
                    </div>

                    <div className="achievements">
                        <h2>Achievements</h2>
                        <br></br>
                        <div className="wrapperAchievement">
                            <div className="achievementItem">Finish 1 Lesson
                            <input type="checkbox" id="achievementCheckBox"></input>
                            </div>
                            <div className="achievementItem">Finish 3 Lessons
                            <input type="checkbox" id="achievementCheckBox2"></input>
                            </div>
                            <div className="achievementItem">Finish 5 Lessons
                            <input type="checkbox" id="achievementCheckBox3"></input>
                            </div>
                            <div className="achievementItem">Finish 1 course
                            <input type="checkbox" id="achievementCheckBox4"></input>
                            </div>
                            <div className="achievementItem">Finish 3 courses
                            <input type="checkbox" id="achievementCheckBox5"></input>
                            </div>
                            <div className="achievementItem">Finish 5 courses
                            <input type="checkbox" id="achievementCheckBox6"></input>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
  }