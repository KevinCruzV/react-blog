import React, { useEffect, useState } from 'react';
import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import ArticleForm from './components/ArticleForm';
import LoginForm from './components/LoginForm';
import ArticleCard from './components/ArticleCard';
import { Card } from 'react-bootstrap';
import CreateForm from './components/CreateForm';

export default function App() {


  const [title, setTitle] = useState<string>('')
  const [content, setContent] = useState<string>('');

  useEffect(() =>{


      const headers = new Headers({
          'Content-Type': 'application/x-www-form-urlencoded',
          'Authorization': 'Bearer cdjkbcshk'
      });



  fetch('http://localhost:2345/src/Controllers/AffichePostController.php', {
    method: 'GET',
    headers : headers,
    mode: 'cors',
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      
      setTitle(data.title)
      setContent(data.content)

    })
  });

    

  return (
    <>
      <div className='container py-5'>
        <LoginForm/>
        <CreateForm/>
        <ArticleForm/>
        <ArticleCard key={1} title={setTitle} content={setContent}/>

      </div>

    </>
    
  );
}


