import '../../css/components/Lesson.css';
import { useParams, useNavigate } from 'react-router-dom';
import LessonAdminButtons from './LessonAdminButtons';
import { useEffect, useState, useRef } from 'react';
import "../../css/components/Modal.css";

export default function Lesson(){
    const course_id = useParams().course_id;
    const position = useParams().lesson_position;

    const [lesson, setLesson] = useState(null);

    //for preventing tab-key from changing focus and place tab-character in textarea instead
    function keyHandler(e) {
        if(e.keyCode == 9) { //when tab key is pressed
            document.getElementById("input").value += "\t";
            if(e.preventDefault) {
                e.preventDefault();
            }
            return false;
        }
    }

    //for navigation buttons
    const navigate = useNavigate();
    const backToCourse = () => {
        navigate("/course/" + lesson.course_id);
    }

    let uri = '/api/course/' + course_id + '/lesson/' + position;

    useEffect(() => {
        let cachedToken = window.localStorage.getItem("token");
        axios.get(uri, {
            headers: { "Authorization": "Bearer " + cachedToken}
        }).then((response) => {
            setLesson(response.data);
        }).catch((error) => {
            window.location.href = '../';
        });
    }, []);

    //state starts at false, so that the popUp window doesnt appear from the beginning
    const [modal, setModal] = useState(false);
    //using use-state to show/hide the popUp window
    const toggleModal = () => {
        setModal(!modal);
    };


    const nextLesson = () => {
        window.location.href = "/course/" + lesson.course_id + "/lesson/" + ++lesson.position;
    }

    function backToCoursePage() {
        //closes popUp window and navigates back to all courses
        toggleModal();
        navigate("/home");
    }

    //when run-button clicked
    const [status, setStatus] = useState();
    const out = useRef();
    function handleRun(){
        let cachedToken = window.localStorage.getItem("token");
        document.getElementById("runButton").classList.add('running');

        axios.post('/api/run/', {
            lesson_id: lesson.id,
            code: document.getElementById("input").value,
            language: lesson.language
        }, { headers: { "Authorization": "Bearer " + cachedToken }}).then((response) => {
            setStatus(response.data.status);
            out.current.value = response.data.text;
        });
        document.getElementById("runButton").classList.remove('running');
    }

    if(lesson===null) {
        return(
            <div className='lesson'>
                Loading...
            </div>
        )
    }

    return (
        <div className='lesson'>
            <div className='innerLesson'>
                {/*<LessonAdminButtons lesson={lesson}/> a removed feature*/}
                <h1 id="lessonHeadline">{lesson.title}</h1>
                <p id="lessonText">{lesson.description}</p>
                <textarea id="input" rows="50" onKeyDown={keyHandler}></textarea>
                <button id="runButton" onClick={handleRun}>Run &gt;&gt;&gt;</button>
                <h2>Output of the Code:</h2>
                <textarea ref={out} id="output" rows="5" placeholder="The output of your Code will appear here" readOnly/>
                <div id='navButtons'>
                    <button onClick={backToCourse}>Back to course</button>
                    <button onClick={nextLesson}>Next lesson</button>
                </div>
            </div>

            {modal &&
            (<div className="modal">
                <div className="overlay"/>
                    <div className="modal-content">
                        <h2>Congratulations!</h2>
                        <h3>You have successfully finished the course.</h3>
                        <button className="close-modal" onClick={backToCoursePage}>Return to all courses</button>
                </div>
            </div>
            )}
        </div>
    );
}
