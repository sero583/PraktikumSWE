import '../../css/components/Lesson.css';
import { useNavigate, useParams } from 'react-router-dom';
// import LessonAdminButtons from './LessonAdminButtons';
import { useEffect, useState, useRef } from 'react';
import "../../css/components/Modal.css";
import axios from 'axios';
import React from 'react';
// for code editor
import Editor from 'react-simple-code-editor';
import { highlight, languages } from 'prismjs/components/prism-core';
import 'prismjs/components/prism-clike';
import 'prismjs/components/prism-javascript';
import 'prismjs/themes/prism.css';
// for loading bar
import LinearProgress from '@mui/material/LinearProgress';

export default function Lesson() {
    const course_id = useParams().course_id;
    const id = useParams().lesson_id;
    const position = useParams().lesson_position; // was before lesson_id
    // const nl2br = require('react-nl2br');
    const parse = require('html-react-parser');

    const [lesson, setLesson] = useState(null);

    /*const setLesson = (lesson) => {
        lesson.description = nl2br
    };*/

    const [visibleCode, setVisibleCode] = useState("");
    const [executionLoading, setExecutionLoading] = useState(false);

    const [nextLessonLoading, setNextLessonLoading] = useState(false);


    const runButton = useRef();
    // default hide time 
    const DEFAULT_HIDE_TIME = 3000;

    // loading colors
    const LOADING_BAR_LOADING_COLOR = "#FFFF00";
    const LOADING_BAR_LOADING_BACKGROUND_COLOR = "#FFBA01";
    // success colors
    const LOADING_BAR_SUCCESS_COLOR = "#00FFAB"; // swap?
    const LOADING_BAR_SUCCESS_BACKGROUND_COLOR = "#14C38E";
    // failiure colors
    const LOADING_BAR_FAILURE_COLOR = "#FFCCCB"; // swap? FF2626
    const LOADING_BAR_FAILURE_BACKGROUND_COLOR = "#FF0000"; //BD1616
    //incorrect output colors
    const LOADING_BAR_INCORRECT_COLOR = "#7093FF";
    const LOADING_BAR_INCORRECT_BACKGROUND_COLOR = "#3366FF";

    const [loadingBarColor, setLoadingBarColor] = useState(LOADING_BAR_LOADING_COLOR);
    const [loadingBarBackgroundColor, setLoadingBarBackgroundColor] = useState(LOADING_BAR_LOADING_BACKGROUND_COLOR);

    const parseOptions = {
        htmlparser2: {
            xmlMode: true,
            lowerCaseTags: false
        }
    };


    const showProgressBar = () => {
        setExecutionLoading(true);
    }
    
    const hideProgressBarUI = () => {
        setExecutionLoading(false);
    }

    const showProgressBarLoading = () => {
        setLoadingBarColor(LOADING_BAR_LOADING_COLOR);
        setLoadingBarBackgroundColor(LOADING_BAR_LOADING_BACKGROUND_COLOR);

        showProgressBar();
    };

    const showProgressBarSuccess = () => {
        setLoadingBarColor(LOADING_BAR_SUCCESS_COLOR);
        setLoadingBarBackgroundColor(LOADING_BAR_SUCCESS_BACKGROUND_COLOR);

        showProgressBar();
    };

    const showProgressBarIncorrectOutput = () => {
        setLoadingBarColor(LOADING_BAR_INCORRECT_COLOR);
        setLoadingBarBackgroundColor(LOADING_BAR_INCORRECT_BACKGROUND_COLOR);

        showProgressBar();
    };

    const showProgressBarFailure = () => {
        setLoadingBarColor(LOADING_BAR_FAILURE_COLOR);
        setLoadingBarBackgroundColor(LOADING_BAR_FAILURE_BACKGROUND_COLOR);

        showProgressBar();
    }

    function hideProgressBarAndUnblockButton(time) {
        if(!isNaN(time)) {
            setTimeout(function(){
                hideProgressBarUI();
                unblockRunButton();
            }, time); //run this after 3 seconds
        } else console.error("Time passed hideProgressBar is not a number. (Time = " + time + ").");
    }

    const blockRunButton = () => {
        runButton.current.disabled = true;
    };

    const unblockRunButton = () => {
        runButton.current.disabled = false;
    };

    const hightlightWithLineNumbers = (input, language) => highlight(input, language)
    .split("\n")
    .map((line, i) => `<span class='editorLineNumber'>${i + 1}</span>${line}`)
    .join("\n");

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
            if(response!=null&&response.data!=null&&"predefined_code_visible" in response.data) {
                // set initially shown code
                setVisibleCode(response.data.predefined_code_visible);
            }
        }).catch((error) => {
            // lead back to course page when loading of lesson fails
            console.log(error);
            window.location.href = '../';
        });
    }, []);

    //state starts at false, so that the popUp window doesnt appear from the beginning
    const [finishedCourseModalVisibility, setFinishedCourseModalVisibility] = useState(false);
    //using use-state to show/hide the popUp window
    const toggleFinishedCourseModalVisibility = () => {
        setFinishedCourseModalVisibility(!finishedCourseModalVisibility);
    };

    const [finishedLessonModalVisibility, setFinishedLessonModalVisibility] = useState(false);
    const toggleFinishedLessonModalVisibility = () => {
        setFinishedLessonModalVisibility(!finishedLessonModalVisibility);
    };

    function hideModals() {
        if(finishedCourseModalVisibility===true) {
            toggleFinishedCourseModalVisibility();
        }
        if(finishedLessonModalVisibility===true) {
            toggleFinishedLessonModalVisibility();
        }
    }


    const nextLesson = () => {
        if(nextLessonLoading===true) return;

        setNextLessonLoading(true);

        // clear output
        out.current.value = "";

        // window.location.href = "/course/" + lesson.course_id + "/lesson/" + ++lesson.position;
        let cachedToken = window.localStorage.getItem("token");

        axios.post("/api/lesson/get-next-lesson", {
            course_id: course_id,
            lesson_position: lesson.position
        }, { headers: { "Authorization": "Bearer " + cachedToken }})
        .then((response) => {
            setNextLessonLoading(false);
            // manipulate URL and data
            let data = response.data;

            if(data.hasNext===true) {
                let lesson = data.lesson;
                setLesson(lesson);

                if(lesson!==null&&"predefined_code_visible" in lesson) {
                    // update shown code
                    setVisibleCode(lesson.predefined_code_visible);
                }
                // Manipulate URL without redirect to new one
                navigate("/course/" + lesson.course_id + "/lesson/" + lesson.position,  { replace: true });
            } else {
                // go back to course main page

                // TODO show course?
                backToCourse();
            }
            hideModals();

            // scroll up again
            window.scrollTo(0, 0);
        }).catch((err) => {
            setNextLessonLoading(false);
            hideModals();
            console.log(err);
            alert("Error occurred during switching lessons");
        });
    }

    function backToCoursePageWithTogglingModal() {
        //closes popUp window and navigates back to all courses
        hideModals();
        backToCourse();
    }

    //when run-button clicked
    const [status, setStatus] = useState();
    const out = useRef();

    function handleRun() {
        if(runButton.current.disabled===true) {
            console.debug("Run button is disabled");
            return;
        }

        let cachedToken = window.localStorage.getItem("token");

        // show loading UI bar
        showProgressBarLoading();
        blockRunButton();

        axios.post('/api/run/', {
            lesson_id: lesson.id,
            code: visibleCode
        }, { headers: { "Authorization": "Bearer " + cachedToken }})
        .then((response) => {
            let status = response.data.status;
            let courseCompleted = response.data.courseCompleted;
            let success = response.data.success;

            setStatus(status);
            out.current.value = response.data.text;

            // its only about compiling went good, correct output will be rewarded with a popup afterwards
            if(status===0) {
                // show success UI bar
                showProgressBarSuccess();
                // hide bar after default time
                hideProgressBarAndUnblockButton(DEFAULT_HIDE_TIME);
            } else if (status===4) {
                showProgressBarIncorrectOutput();
                hideProgressBarAndUnblockButton(DEFAULT_HIDE_TIME);

            } else {
                // show failure UI bar
                showProgressBarFailure();
                //  hide bar after default time
                hideProgressBarAndUnblockButton(DEFAULT_HIDE_TIME);
            }

            // check in response for success and courseCompleted
            // only one gets shown: When lesson and course has been simulatenously completed, course completed will
            if(courseCompleted===true) {
                // course completed -> show popup
                setFinishedCourseModalVisibility(true);
            } else if(success===true) {
                // successfully finished lesson -> show popup
                setFinishedLessonModalVisibility(true);
            }           
        }).catch((exeception) => {
            // show failure UI bar
            showProgressBarFailure();
            //  hide bar after default time
            hideProgressBarAndUnblockButton(DEFAULT_HIDE_TIME);
        });
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
                <div id="lessonTextContainer">
                    {/*parse("<p id=\"lessonText\">" + lesson.description.replaceAll("\n", "<br/>") + "</p>", parseOptions)*/}
                        {parse("<p id=\"lessonText\">" + lesson.description.replaceAll("\n", "<br/>") + "</p>", parseOptions)}

                        {/*<JsxParser
                            bindings={{language: "python"}}
                            components={{ SyntaxHighlighter }}
                            jsx={lesson.description.replaceAll("\n", "<br/>")}
                          />*/}

                        {/*<p id="lessonText">
                    {nl2br(lesson.description)}
                    </p>*/}
                </div>

                <br/>

                <Editor
                    value={visibleCode}
                    onValueChange={changedCode => setVisibleCode(changedCode)}
                    highlight={code => hightlightWithLineNumbers(code, languages.js)}
                    padding={10}
                    insertSpaces={false}
                    tabSize={1}
                    textareaId="codeArea"
                    className="editor"
                    style={{
                        fontFamily: '"Fira code", "Fira Mono", monospace',
                        fontSize: 14,
                        outline: 0
                    }}
                />

                <button ref={runButton} id="runButton" onClick={handleRun}>Run &gt;&gt;&gt;</button>
                <h2>Output of the Code:</h2>

                    {executionLoading && (
                        <LinearProgress id="loadingBar" color="inherit" sx={{ width: "87.5%", backgroundColor: loadingBarBackgroundColor, color: loadingBarColor }}  />
                        //  "#FF0000", color: "#75f" 
                    )}
                
                <div style={{margin: "10px 0 2px 0" }}></div>

                <textarea ref={out} id="output" rows="5" placeholder="The output of your Code will appear here" readOnly/>
                <div id='navButtons'>
                    <button onClick={backToCourse}>Back to course</button>
                    <button onClick={nextLesson}>Next lesson</button>
                </div>
            </div>

            {finishedLessonModalVisibility &&
                (<div className="modal">
                    <div className="overlay"/>
                        <div className="modal-content">
                            <h2>Congratulations!</h2>
                            <h3>You have completed this lesson.</h3>
                            <button className="bottom-right-button" onClick={nextLesson}>Next lesson</button>
                            <button className="top-right-button" onClick={hideModals}>X</button>
                    </div>
                </div>
            )}

            {finishedCourseModalVisibility &&
                (<div className="modal">
                    <div className="overlay"/>
                        <div className="modal-content">
                            <h2>Congratulations!</h2>
                            <h3>You have successfully finished the course.</h3>
                            <button className="bottom-right-button" onClick={backToCoursePageWithTogglingModal}>Return to all courses</button>
                            <button className="top-right-button" onClick={hideModals}>X</button>
                    </div>
                </div>
            )}
        </div>
    );
}
