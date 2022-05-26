import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Routes, Route, Navigate, useNavigate } from 'react-router-dom';
import Layout from './Layout'
import LandingPage from './LandingPage'
import Home from './Home';
import Course from './Course';
import Lesson from './Lesson';
import Login from './Login';
import Register from './Register';
import NoPage from './NoPage';
import UserPage from './UserPage';
import CreateLesson from './CreateLesson';
import '../../css/components/Global.css';
import ForgotPassword from './ForgotPassword';
import ForgotPasswordSubmit from './ForgotPasswordSubmit';

export default function App() {
  const [token, setToken] = useState();
  const [isTokenValidated, setTokenValidated] = useState(); // set to true, when valid - set to false when expired/invalid

  useEffect(() => {
    let cachedToken = window.localStorage.getItem("token");

    if(cachedToken) {
      axios.get("/api/users/validate-token", {
        headers: { "Authorization": "Bearer " + cachedToken }
      }).then(function(response) {
        if(response) {
          console.log("Data: ");
          console.log(response.data);
          console.log("Status: " + response.data.status);

          if(response.data.success===true) {
            console.log("Success!");
  
            setToken(cachedToken);
            setTokenValidated(true);
          } else {
            // token invalid
            window.localStorage.removeItem("token");
            setTokenValidated(false);
            setToken(null);
            console.log("Invalid!!!");
          }
          console.log(response);
        } else alert("Couldn't verify token.");
      }).catch(function(error) {
          // invalid token -> delete and return false
          console.log("Error!!!");
          console.log(error);
          window.localStorage.removeItem("token");
          setTokenValidated(false);
      });
    } else setTokenValidated(false); // not logged in
  }, []);

  function shouldRedirect() {
    return !isTokenValidated;
  }

  return ( isTokenValidated!=null ?
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout receiveValue={token} />}>
          <Route index element={shouldRedirect() ? <LandingPage /> : (<Home />)} />
          <Route path="home" element={shouldRedirect() ? (<Navigate replace to="/" />) : (<Home />)} />
          <Route path="course/:course_id" element={shouldRedirect() ? (<Navigate replace to="/" />) : (<Course />)} />
          <Route path="course/:course_id/lesson" element={shouldRedirect() ? (<Navigate replace to="/" />) : (<CreateLesson />)}/>
          <Route path="course/:course_id/lesson/:lesson_id" element={shouldRedirect() ? (<Navigate replace to="/" />) : (<Lesson />)}/>
          <Route path="user" element={shouldRedirect() ? (<Navigate replace to="/" />) : (<UserPage />)}/>
          <Route path="login" element={<Login setToken={setToken}/>} />
          <Route path="register" element={<Register />} />
          <Route path="forgotpassword" element={<ForgotPassword />} />
          <Route path="forgotpasswordsubmit" element={<ForgotPasswordSubmit />} />
          <Route path="*" element={<NoPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
    : <div/> // Just return div for white screen, so until the token hasn't been verified (aka loading), nothing will be shown. Afterwards the application will launch.
  );
}

if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}