
import { useState } from "react"

// Interface pour rentrer le state location du parent en tant que props


//Composant pour le formulaire 
export default function LoginForm(){
    const [username, setUsername] = useState<string>('');
    const [pass, setPass] = useState<string>('');
    const [token, setToken] = useState<string>('');


    const  generateRandomString = (num: number) => {
        const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result1= Math.random().toString(36).substring(0,num);       

        return result1;
    }



    // 
    const handleChange1 = (e:any) => {
        const {value} = e.target;
        setUsername(value);
        console.log(value);
    }


    const handleChange2 = (e:any) => {
        const {value} = e.target;
        setPass(value);
        console.log(value);
    }

    const handleSubmit = (e:any) => {


        
        setToken(generateRandomString(20));

        const body = new URLSearchParams({
            username: username,
            pass: pass
        });
    
        const headers = new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': token
        });
    

      
        fetch('http://localhost:2345/src/Controllers/UserController.php', {
            method: 'GET',
            headers : headers,
            body: body,
            mode: 'cors',
            credentials: 'include'
        })
        .then(res => res.json())
        .then(data => {
            console.log(data)
        })
        
        
    }
    
    return(
        <form className="mx-auto" style={{maxWidth:"350px"}} onSubmit={handleSubmit}>
            <h1 className="text-center mb-3">Sign-in</h1>
            <label htmlFor="username">Username :</label>
            <input type="text" name="username" className="form-control" value={username} onChange={handleChange1}/>
            <label htmlFor="password">Password :</label>
            <input type="password" name="pass" className="form-control"value={pass} onChange={handleChange2} />
            <button type="submit" className="btn btn-primary">Envoyer</button>
            <button className="btn btn-primary">Sign-Up</button>
        </form>
    )
};

