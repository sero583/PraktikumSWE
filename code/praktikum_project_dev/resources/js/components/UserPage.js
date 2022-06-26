import '../../css/components/UserPage.css';
import ReactDOM from 'react-dom';
import { useEffect, useState } from 'react';
import axios from 'axios';
import CourseCardSmall from './CourseCardSmall';

export default function UserPage() {
    const [data, setData] = useState(null);

    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");
        
        axios.get("/api/users/view-profile", {
            headers: { "Authorization": "Bearer " + cachedToken }
          }).then(function(response) {
            if(response&&response.status===200) {
                let responseData = response.data.data;
                setData(responseData);
            } else alert("Couldn't load user data.");
          }).catch(function(error) {
              // invalid token -> delete and return false
              console.log("Error during loading user data.");
              console.log(error);
          });
      }, []);

    if(data===null) {
        // just show a empty page during loading
        return (
            <div/>
        )
    } else {
        console.log(data);

        return (
            <div className="userpage">
                <h1>User page</h1>
                <div className="outerDiv">
                    <div className="accountInfo">
                        <h2>Account information</h2>
                        <label htmlFor="username">Username</label><br/>
                        <input type="text" id="username" value={data.user.name} placeholder="Loading..." readOnly="readonly"/><br/>
                        
                        <label htmlFor="email">Email</label><br/>
                        <input type="text" id="email" value={data.user.email} placeholder="Loading..." readOnly="readonly"/><br/>

                        <label htmlFor="text">Collected XP</label>
                        <input type="text" id="xp" value={data.xp} readOnly="readonly"/>
                    </div>

                    <div className="courseProgress">
                        <h2>Course Progress</h2>

                        <label htmlFor="completedCourses">Completed courses</label>
                        <div id="completedCourses" className="wrapperCompleted">
                            {/* Dummy data
                            <div className="completedItem">Course-1</div>
                            <div className="completedItem">Course-2</div>
                            <div className="completedItem">Course-3</div>
                            <div className="completedItem">Course-4</div>
                            <div className="completedItem">Course-5</div>
                            <div className="completedItem">Course-6</div>
                            <div className="completedItem">Course-7</div>
                            <div className="completedItem">Course-8</div>
                            <div className="completedItem">Course-9</div>
                            <div className="completedItem">Course-10</div>*/}

                            {data.progress.finished_courses.length!==0 ? data.progress.finished_courses.map(finished_course => {
                                return /*<div className="completedItem">{finished_course.title}</div>*/<CourseCardSmall key={finished_course.id} course={finished_course} />
                            }) : "Seems pretty empty here. Go ahead and complete some courses!"}
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <label htmlFor="startedCourses">Started courses</label>
                        <div id="startedCourses" className="wrapperStarted">
                            {/*<div className="startedItem">Course-1</div>
                            <div className="startedItem">Course-2</div>
                            <div className="startedItem">Course-3</div>
                            <div className="startedItem">Course-4</div>
                            <div className="startedItem">Course-5</div>
                            <div className="startedItem">Course-6</div>
                            <div className="startedItem">Course-7</div>
                            <div className="startedItem">Course-8</div>
                            <div className="startedItem">Course-9</div>
                            <div className="startedItem">Course-10</div>*/}

                            {data.progress.started_courses.length!==0 ? data.progress.started_courses.map(started_course => {
                                return /*<div className="startedItem">{started_course.title}</div>*/<CourseCardSmall key={started_course.id} course={started_course} />
                            }) : "Seems pretty empty here. Go ahead and start some courses!"}
                        </div>
                    </div>

                    <div className="achievements">
                        <h2>Achievements</h2>
                        <br/>
                        <div id="achievements" className="wrapperAchievement">
                            {/*<div className="achievementItem">Finish 1 Lesson
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
                            </div>*/}

                            {data.achievemenets.length!==0 ? data.achievemenets.map(achievement => {
                                return <div className="achievementItem"><p>{achievement}</p></div>
                            }) : "Seems pretty empty here. Go ahead and collect some achievements!"}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
  }