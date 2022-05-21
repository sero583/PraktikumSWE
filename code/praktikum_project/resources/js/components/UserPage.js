import '../../css/components/UserPage.css';
import ReactDOM from 'react-dom';

export default function UserPage() {

    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      } 

    return (
        <div className="userpage">
            <h1>User page</h1>
            <div className="outerDiv">
                <div className="accountInfo">
                    <h2>Account information</h2>
                    <label for="username">Username</label><br></br>
                    <input type="text" id="username" value="test" readOnly="readonly"></input><br></br>
                    
                    <label for="email">Email</label><br></br>
                    <input type="text" id="email" value="test@gmail.com" readOnly="readonly"></input><br></br>

                    <label for="password">Password</label><br></br>         
                    <input type="password" id="password" value="password123"></input><br></br>
                    <strong>Show password</strong>
                    <input type="checkbox" id="checkBox" onClick={showPassword}></input>
                </div>

                <div className="courseProgress">
                    <h2>Course Progress</h2>

                    <label for="completedCourses">Completed courses</label>
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
                    <label for="startedCourses">Started courses</label>
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