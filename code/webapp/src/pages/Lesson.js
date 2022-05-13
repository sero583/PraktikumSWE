import './styles/Lesson.css';
import { useParams, useNavigate } from 'react-router-dom';
import LessonAdminButtons from './LessonAdminButtons';

export default function Lesson(){
    const course_id = useParams().course_id;
    const id = useParams().lesson_id;
    //to be replaced with data from the server
    const headline = "Name of the lesson"
    const text = "Instructions what has to be implemented";

    //for navigation buttons
    const navigate = useNavigate();
    const backToCourse = () => {
        navigate("/course/" + course_id);
    }
    const nextLesson = () => {
        //doesn't actually go to next lesson
        navigate("/course/" + course_id + "/lesson/" + id);
    }

    //when run-button clicked
    function handleRun(){
        const code = document.getElementById("input").value;

        //send code to server and get output
        const output = "Run finished with code:\n" + code;

        document.getElementById("output").textContent = output;
    }

    return (
        <div className='lesson'>
            <div className='innerLesson'>
                <LessonAdminButtons course_id={course_id}/>
                <h1 id="lessonHeadline">{headline}</h1>
                <p id="lessonText">{text}</p>
                <textarea id="input" rows="50"></textarea>
                <button onClick={handleRun}>Run &gt;&gt;&gt;</button>
                <h2>Output of the Code:</h2>
                <textarea id="output" rows="5" placeholder="The output of your Code will appear here" readOnly></textarea>
                <div id='navButtons'>
                    <button onClick={backToCourse}>Back to course</button>
                    <button onClick={nextLesson}>Next lesson</button>
                </div>
            </div>
        </div>
    );
}