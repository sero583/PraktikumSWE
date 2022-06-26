//import '../../css/components/CreateLesson.css';
import { useParams, useNavigate } from 'react-router-dom';

export default function CreateLesson(){
    const course_id = useParams.course_id;
    
    //for navigation buttons
    const navigate = useNavigate();
    function save(){
        //send data to server
        navigate("/course/" + course_id);
    }
    function discard(){
        navigate("/course/" + course_id);
    }
    
    return (
        <div className='lesson'>
            <div className='innerLesson'>
                <h1 id="newLessonHeadline" contentEditable>New Lesson</h1>
                <p id="newLessonText" contentEditable>Description for what has to be implemented</p>
                <textarea id="newInput" rows="50"></textarea>
                <h2>Output of the Code:</h2>
                <textarea id="newOutput" rows="5"></textarea>
                <div id='navButtons'>
                    <button onClick={save}>Save</button>
                    <button onClick={discard}>Discard</button>
                </div>
            </div>
        </div>
    );
}