import '../../css/components/Lesson.css';
import { useParams, useNavigate } from 'react-router-dom';
import LessonAdminButtons from './LessonAdminButtons';
import { useEffect, useState } from 'react';



export default function Lesson(){
    const course_id = useParams().course_id;
    const id = useParams().lesson_id;

    //fetching data from server
    const [isLoading, setLoading] = useState(true);
    const [lesson, setLesson] = useState();
    let uri = '/api/course/' + course_id + '/lesson/' + id;
    useEffect(() => {
        axios.get(uri).then((response) => {
            setLesson(response.data);
            setLoading(false);
        });
    }, []);

    //for navigation buttons
    const navigate = useNavigate();
    const backToCourse = () => {
        navigate("/course/" + lesson.course_id);
    }


    const nextLesson = () => {
        if(lesson.next_lesson){
            navigate("/course/" + lesson.course_id + "/lesson/" + lesson.next_lesson);
            window.location.reload();
        }
        else{
            
            // Link to Pop-Up window
            navigate("/course/" + lesson.course_id);
        }
    }

    //when run-button clicked
    function handleRun(){
        const code = document.getElementById("input").value;

        //send code to server and get output
        const output = "Run finished with code:\n" + code;

        document.getElementById("output").textContent = output;
    }

    if(isLoading){
        return(
            <div className='lesson'>
                Loading...
            </div>
        )
    }

    return (
        <div className='lesson'>
            <div className='innerLesson'>
                <LessonAdminButtons lesson={lesson}/>
                <h1 id="lessonHeadline">{lesson.title}</h1>
                <p id="lessonText">{lesson.description}</p>
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