import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import Layout from './pages/Layout'
import LandingPage from './pages/LandingPage'
import Home from './pages/Home';
import Course from './pages/Course';
import Lesson from './pages/Lesson';
import Login from './pages/Login';
import Register from './pages/Register';
import NoPage from './pages/NoPage';
import './pages/styles/Global.css';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <BrowserRouter>
    <Routes>
      <Route path="/" element={<Layout />}>
        <Route index element={<LandingPage />} />
        <Route path="home" element={<Home />} />
        <Route path="course/:course_id" element={<Course />} />
        <Route path="course/:course_id/lesson/:lesson_id" element={<Lesson />}/>
        <Route path="login" element={<Login />} />
        <Route path="register" element={<Register />} />
        <Route path="*" element={<NoPage />} />
      </Route>
    </Routes>
  </BrowserRouter>
);