import React, { useEffect } from 'react';
import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import ArticleForm from './components/ArticleForm';

export default function App() {

  useEffect(() =>{
    fetch('http://localhost:2345', {
      method: 'POST'
    })
      .then(res => res.json())
      .then(data => console.log(data))
  });

  return (
    <>
      <div className='container'>
      <ArticleForm/>
      </div>
    </>
    
  );
}


