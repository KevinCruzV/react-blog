import React, { useEffect, useState } from 'react';
import logo from './logo.svg';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import ArticleForm from './components/ArticleForm';
import LoginForm from './components/LoginForm';
import ArticleCard from './components/ArticleCard';
import { Card } from 'react-bootstrap';

export default function App() {

  const [username, setUsername] = useState<string>('');
  const [pass, setPass] = useState<string>('');
  const [cards, setCards] = useState<object>({});

  useEffect(() =>{

      const body = new URLSearchParams({
          username: username,
          pass: pass
      });

      const headers = new Headers({
          'Content-Type': 'application/x-www-form-urlencoded',
          'Authorization': 'Bearer cdjkbcshk'
      });

    //   const headers2 = new Headers({
    //     'Content-Type': 'application/x-www-form-urlencoded',
    //     'Authorization': 'Bearer cdjkbcshk'
    // });


  //   fetch('http://localhost:2345/src/Controllers/UserControllers.php', {
  //     method: 'GET',
  //     headers : headers,
  //     mode: 'cors',
  //     credentials: 'include'
  //   })
  //     .then(res => res.json())
  //     .then(data => {
  //         console.log(data)
  //     })
  // });


  fetch('http://localhost:2345/src/Controllers/AffichePostController.php', {
    method: 'GET',
    headers : headers,
    mode: 'cors',
    credentials: 'include'
  })
    .then(res => res.json())
    .then(data => {
      
      setCards(data)
    })
  });

    

  return (
    <>
      <div className='container py-5'>
        <LoginForm setUsername={setUsername} setPass={setPass}/>

        <ArticleForm/>

      </div>

    </>
    
  );
}


