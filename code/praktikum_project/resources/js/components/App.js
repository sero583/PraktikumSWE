import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './Layout'
import LandingPage from './LandingPage'
import Home from './Home';
import Course from './Course';
import Lesson from './Lesson';
import Login from './Login';
import Register from './Register';
import NoPage from './NoPage';
import UserPage from './UserPage';
import '../../css/components/Global.css';

export default function App() {
  const [token, setToken] = useState();
  let shouldRedirect = false;
  if(!token) {
    shouldRedirect = true;
  }
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Layout />}>
          <Route index element={<LandingPage />} />
          <Route path="home" element={shouldRedirect ? (<Navigate replace to="/" />) : (<Home />)} />
          <Route path="course/:course_id" element={shouldRedirect ? (<Navigate replace to="/" />) : (<Course />)} />
          <Route path="course/:course_id/lesson/:lesson_id" element={shouldRedirect ? (<Navigate replace to="/" />) : (<Lesson />)}/>
          <Route path="user" element={shouldRedirect ? (<Navigate replace to="/" />) : (<UserPage />)}/>
          <Route path="login" element={<Login setToken={setToken}/>} />
          <Route path="register" element={<Register />} />
          <Route path="*" element={<NoPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}